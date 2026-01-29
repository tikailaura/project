<?php
require __DIR__ . '/../includes/db.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

$user = $_SESSION['user'];

function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome <?= e($user['firstname']) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header class="header">
    <div class="logo">🍍 pineapple.</div>
</header>

<main class="container">
    <h1>Welcome <?= e($user['firstname']) ?> <?= e($user['lastname']) ?></h1>
    <a href="logout.php" data-test="logout">Logout</a>
</main>
</body>
</html>
