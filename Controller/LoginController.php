<?php
session_start();

require "../Model/User.php";

$email = sanitize($_POST['email']);
$password = sanitize($_POST['password']);
$isValid = true;

$_SESSION['err1'] = "";
$_SESSION['err2'] = "";
$_SESSION['email'] = "";
$_SESSION['password'] = "";
$_SESSION['err3'] = "";
$_SESSION['isRegister'] = false;
$_SESSION['isLoggedIn'] = false;

if (empty($email)) {
    $_SESSION['err1'] = "Please fill up the email properly.";
    $isValid = false;
} else {
    $_SESSION['email'] = $email;
}

if (empty($password)) {
    $_SESSION['err2'] = "Please fill up the password properly.";
    $isValid = false;
} else {
    $_SESSION['password'] = $password;
}

if ($isValid) {
    $isUser = matchCredentials($email, $password);
    if ($isUser) {
        $_SESSION['isLoggedIn'] = true;
        header("Location: ../View/Shop.php");
    } else {
        $_SESSION['err3'] = "Login failed.";
        header("Location: ../View/Login.php");
    }
} else {
    header("Location: ../View/Login.php");
}

function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
