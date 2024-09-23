<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: ../View/Login.php");
    exit();
}

require "../Model/User.php";

$oldPassword = sanitize($_POST['oldPassword']);
$newPassword = sanitize($_POST['newPassword']);
$confirmPassword = sanitize($_POST['confirmPassword']);

$_SESSION['error'] = "";
$isValid = true;

if (empty($oldPassword)) {
    $_SESSION['error'] = "Please enter your old password.";
    $isValid = false;
}
if (empty($newPassword)) {
    $_SESSION['error'] = "Please enter a new password.";
    $isValid = false;
}
if (empty($confirmPassword)) {
    $_SESSION['error'] = "Please confirm your new password.";
    $isValid = false;
}

if ($newPassword !== $confirmPassword) {
    $_SESSION['error'] = "New password and confirm password do not match.";
    $isValid = false;
}

if ($isValid) {
    $email = $_SESSION['email']; 
    if (checkOldPassword($email, $oldPassword)) { 
        $updateSuccess = updatePassword($email, $newPassword); 

        if ($updateSuccess) {
            $_SESSION['success'] = "Password changed successfully!";
            header("Location: ../View/Profile.php");
        } else {
            $_SESSION['error'] = "Failed to update password. Please try again.";
            header("Location: ../View/ChangePassword.php");
        }
    } else {
        $_SESSION['error'] = "Old password is incorrect.";
        header("Location: ../View/ChangePassword.php");
    }
} else {
    header("Location: ../View/ChangePassword.php");
}

function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
