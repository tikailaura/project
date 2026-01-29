<?php
require __DIR__ . '/db.php';

function redirect($url, $type, $message) {
    $_SESSION[$type] = $message;
    header("Location: $url");
    exit;
}

function validate_email($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validate_password($password) {
    return preg_match('/^(?=.*[A-Za-z])(?=.*\d).{8,}$/', $password);
}

function get_user_by_email($pdo, $email) {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch();
}

// ----- LOGIN -----
if (isset($_POST['login'])) {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!$email) redirect('../public/index.php', 'error', "Email address is required");
    if (!validate_email($email)) redirect('../public/index.php', 'error', "Please provide a valid e-mail address");

    $user = get_user_by_email($pdo, $email);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        redirect('../public/success.php', 'success', "Login successful");
    }

    redirect('../public/index.php', 'error', "Invalid credentials");
}

// ----- REGISTER -----
if (isset($_POST['register'])) {
    $firstname = trim($_POST['firstname'] ?? '');
    $lastname  = trim($_POST['lastname'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $confirm   = $_POST['passwordConfirm'] ?? '';
    $subscribed = isset($_POST['subscribed']) ? 1 : 0;

    if (!$firstname || !$lastname || !$email || !$password) {
        redirect('../public/index.php', 'error', "All fields are required");
    }

    if (!validate_email($email)) redirect('../public/index.php', 'error', "Please provide a valid e-mail address");
    if ($password !== $confirm) redirect('../public/index.php', 'error', 'Passwords do not match');
    if (!validate_password($password)) redirect('../public/index.php', 'error', "Password must be 8+ chars with letters and numbers");

    if (get_user_by_email($pdo, $email)) redirect('../public/index.php', 'error', "Email already exists");

    $stmt = $pdo->prepare(
        "INSERT INTO users (firstname, lastname, email, password, subscribed) VALUES (?, ?, ?, ?, ?)"
    );
    $stmt->execute([
        $firstname,
        $lastname,
        $email,
        password_hash($password, PASSWORD_DEFAULT),
        $subscribed
    ]);

    redirect('../public/index.php', 'success', "Registration successful");
}
