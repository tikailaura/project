<?php
require __DIR__ . '/../includes/db.php';

// Helper function to show messages
function show_message($type) {
    if (!empty($_SESSION[$type])) {
        echo "<p class=\"$type\">{$_SESSION[$type]}</p>";
        unset($_SESSION[$type]);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    <link rel="stylesheet" href="/project/assets/style.css"> 
<script src="/project/assets/app.js" defer></script>
</head>
<body>

<header class="header">
    <div class="logo">🍍 pineapple.</div>
    <nav>
        <a href="#">WHAT'S NEW</a>
        <a href="#">WOMEN</a>
        <a href="#">MEN</a>
        <a href="#">GEAR</a>
        <a href="#">TRAINING</a>
        <a href="#">SALE</a>
    </nav>
</header>

<div class="messages">
    <?php show_message('error'); show_message('success'); ?>
</div>

<main class="container">

    <div class="card">
        <h2>CUSTOMER LOGIN</h2>
        <form method="POST" action="/includes/auth.php">
            <label>Email</label>
            <input type="email" name="email" data-test="login-email" required>

            <label>Password</label>
            <input type="password" name="password" data-test="login-password" required>

            <button name="login" data-test="login-submit">Sign In</button>
        </form>
    </div>

    <div class="card">
        <h2>CREATE NEW CUSTOMER ACCOUNT</h2>
        <form method="POST" action="../includes/auth.php" id="registerForm">
            <label>First Name</label>
            <input name="firstname" data-test="register-firstName" required>

            <label>Last Name</label>
            <input name="lastname" data-test="register-lastName" required>

            <label>Email</label>
            <input type="email" name="email" data-test="register-email" required>

            <label>Password</label>
            <input type="password" name="password" data-test="register-password" required>

            <label>Confirm Password</label>
            <input type="password" name="passwordConfirm" data-test="register-passwordConfirm" required>

            <label class="checkbox">
                <input type="checkbox" name="subscribed" data-test="register-newsletter">
                Sign up for Newsletter
            </label>

            <button name="register" data-test="register-submit">Create an Account</button>
        </form>
    </div>

</main>
</body>
</html>
