<?php

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

    protected function requireLogin(): void
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /public/login');
            exit;
        }
    }

    protected function requireAdmin(): void
    {
        $this->requireLogin();

        if (($_SESSION['usuario']['rol'] ?? '') !== 'admin') {
            header('Location: /public');
            exit;
        }
    }

    protected function redirectIfLoggedIn(): void
    {
        if (isset($_SESSION['usuario'])) {
            header('Location: /public');
            exit;
        }
    }
}