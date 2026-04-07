from pathlib import Path
import re

ROOT = Path(__file__).resolve().parent

INDEX_PHP = """<?php

session_start();

require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Router.php';

$appConfig = require __DIR__ . '/../config/app.php';

if (!function_exists('base_url')) {
    function base_url(string $path = ''): string
    {
        $config = require __DIR__ . '/../config/app.php';
        $base = rtrim($config['base_url'] ?? '/public', '/');
        $path = ltrim($path, '/');

        if ($path === '') {
            return $base;
        }

        return $base . '/' . $path;
    }
}

if (!function_exists('redirect_to')) {
    function redirect_to(string $path = ''): void
    {
        $config = require __DIR__ . '/../config/app.php';
        $base = rtrim($config['base_url'] ?? '/public', '/');

        if (strpos($path, '/public') === 0) {
            $path = $base . substr($path, strlen('/public'));
        } elseif (!preg_match('#^https?://#', $path)) {
            $path = $path === '' ? $base : $base . '/' . ltrim($path, '/');
        }

        header('Location: ' . $path);
        exit;
    }
}

try {
    Database::connect();

    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $baseUrl = rtrim($appConfig['base_url'] ?? '/public', '/');

    if ($baseUrl !== '/public' && strpos($path, $baseUrl) === 0) {
        $path = '/public' . substr($path, strlen($baseUrl));

        if ($path === '') {
            $path = '/public';
        }
    }

    $router = new Router();
    $router->dispatch($path);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
"""

CONTROLLER_PHP = """<?php

class Controller
{
    protected function render(string $view, array $data = []): void
    {
        extract($data);

        ob_start();
        require __DIR__ . '/../app/views/' . $view . '.php';
        $content = ob_get_clean();

        require __DIR__ . '/../app/views/layouts/main.php';
    }

    protected function url(string $path = ''): string
    {
        return base_url($path);
    }

    protected function redirect(string $path = ''): void
    {
        redirect_to($path);
    }

    protected function requireLogin(): void
    {
        if (!isset($_SESSION['usuario'])) {
            $this->redirect('login');
        }
    }

    protected function requireAdmin(): void
    {
        $this->requireLogin();

        if (($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
            $this->redirect();
        }
    }

    protected function requireTecnico(): void
    {
        $this->requireLogin();

        if (($_SESSION['usuario']['rol'] ?? '') !== 'tecnico') {
            $this->redirect();
        }
    }

    protected function requireParticular(): void
    {
        $this->requireLogin();

        if (($_SESSION['usuario']['rol'] ?? '') !== 'particular') {
            $this->redirect();
        }
    }

    protected function redirectIfLoggedIn(): void
    {
        if (isset($_SESSION['usuario'])) {
            $this->redirect();
        }
    }
}
"""

VIEW_FILES = [
    "src/app/views/layouts/main.php",
    "src/app/views/auth/login.php",
    "src/app/views/auth/register.php",
    "src/app/views/usuarios/index.php",
    "src/app/views/usuarios/create.php",
    "src/app/views/usuarios/edit.php",
    "src/app/views/usuarios/profile.php",
    "src/app/views/cliente_incidencias/index.php",
    "src/app/views/cliente_incidencias/create.php",
    "src/app/views/tecnicos/index.php",
    "src/app/views/tecnicos/create.php",
    "src/app/views/tecnicos/edit.php",
    "src/app/views/especialidades/index.php",
    "src/app/views/especialidades/create.php",
    "src/app/views/especialidades/edit.php",
    "src/app/views/home/index.php",
    "src/app/views/admin/index.php",
    "src/app/views/admin/create.php",
    "src/app/views/admin/edit.php",
    "src/app/views/admin/calendario.php",
]

CONTROLLER_FILES = [
    "src/app/controllers/AdminController.php",
    "src/app/controllers/UsuarioController.php",
    "src/app/controllers/ClienteIncidenciaController.php",
    "src/app/controllers/TecnicoController.php",
    "src/app/controllers/EspecialidadController.php",
]

SPECIAL_CONTROLLER_REPLACEMENTS = [
    (
        "header('Location: /public/usuarios/edit?id=' . $id . '&error=campos_vacios');\n            exit;",
        "$this->redirect('usuarios/edit?id=' . $id . '&error=campos_vacios');",
    ),
    (
        "header('Location: /public/usuarios/edit?id=' . $id . '&error=email_invalido');\n            exit;",
        "$this->redirect('usuarios/edit?id=' . $id . '&error=email_invalido');",
    ),
    (
        "header('Location: /public/usuarios/edit?id=' . $id . '&error=email_duplicado');\n            exit;",
        "$this->redirect('usuarios/edit?id=' . $id . '&error=email_duplicado');",
    ),
]

HREF_PATTERN = re.compile(
    r'href="/public(?:/(?P<path>[^"?<>#]*))?(?P<suffix>(?:\?[^"]*)?(?:#[^"]*)?)"'
)

ACTION_PATTERN = re.compile(
    r'action="/public(?:/(?P<path>[^"?<>#]*))?(?P<suffix>(?:\?[^"]*)?)"'
)

HEADER_PATTERN = re.compile(
    r"header\('Location: /public(?:/(?P<path>[^'?;\n]*))?(?P<suffix>\?[^']*)?'\);\s*exit;"
)

def write_file(relative_path: str, content: str) -> None:
    file_path = ROOT / relative_path
    file_path.parent.mkdir(parents=True, exist_ok=True)
    file_path.write_text(content, encoding="utf-8", newline="\n")
    print(f"[OK] Reescrito: {relative_path}")

def replace_all(text: str, replacements: list[tuple[str, str]]) -> str:
    for old, new in replacements:
        text = text.replace(old, new)
    return text

def replace_href(match: re.Match) -> str:
    path = (match.group("path") or "").strip("/")
    suffix = match.group("suffix") or ""

    if path:
        return f'href="<?= base_url(\'{path}\') ?>{suffix}"'
    return f'href="<?= base_url() ?>{suffix}"'

def replace_action(match: re.Match) -> str:
    path = (match.group("path") or "").strip("/")
    suffix = match.group("suffix") or ""

    if path:
        return f'action="<?= base_url(\'{path}\') ?>{suffix}"'
    return f'action="<?= base_url() ?>{suffix}"'

def replace_header(match: re.Match) -> str:
    path = (match.group("path") or "").strip("/")
    suffix = match.group("suffix") or ""
    route = f"{path}{suffix}"

    if route:
        return f"$this->redirect('{route}');"
    return "$this->redirect();"

def patch_views() -> None:
    for relative_path in VIEW_FILES:
        file_path = ROOT / relative_path
        if not file_path.exists():
            print(f"[WARN] No existe: {relative_path}")
            continue

        text = file_path.read_text(encoding="utf-8")
        original = text

        text = HREF_PATTERN.sub(replace_href, text)
        text = ACTION_PATTERN.sub(replace_action, text)

        if text != original:
            file_path.write_text(text, encoding="utf-8", newline="\n")
            print(f"[OK] Vistas parcheadas: {relative_path}")
        else:
            print(f"[SKIP] Sin cambios: {relative_path}")

def patch_controllers() -> None:
    for relative_path in CONTROLLER_FILES:
        file_path = ROOT / relative_path
        if not file_path.exists():
            print(f"[WARN] No existe: {relative_path}")
            continue

        text = file_path.read_text(encoding="utf-8")
        original = text

        text = replace_all(text, SPECIAL_CONTROLLER_REPLACEMENTS)
        text = HEADER_PATTERN.sub(replace_header, text)

        if text != original:
            file_path.write_text(text, encoding="utf-8", newline="\n")
            print(f"[OK] Controlador parcheado: {relative_path}")
        else:
            print(f"[SKIP] Sin cambios: {relative_path}")

def main() -> None:
    write_file("src/public/index.php", INDEX_PHP)
    write_file("src/core/Controller.php", CONTROLLER_PHP)
    patch_views()
    patch_controllers()
    print("\\nParche aplicado. Revisa ahora con git diff o git status.")

if __name__ == "__main__":
    main()