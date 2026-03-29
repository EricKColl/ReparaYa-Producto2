<?php
$title = 'Inicio - ReparaYa';

ob_start();
?>

<p>Base inicial del proyecto preparada correctamente.</p>

<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/main.php';