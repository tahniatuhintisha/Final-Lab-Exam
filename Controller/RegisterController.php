<?php  
session_start();

require "../Model/User.php"; 

$name = sanitize($_POST['name']);
$email = sanitize($_POST['email']);
$password = sanitize($_POST['password']);
$confirmPassword = sanitize($_POST['confirmPassword']);
$contact = sanitize($_POST['contact']);
$gender = sanitize($_POST['gender']);

$isValid = true;

$_SESSION['err_name'] = "";
$_SESSION['err_email'] = "";
$_SESSION['err_password'] = "";
$_SESSION['err_confirm_password'] = "";
$_SESSION['err_contact'] = "";
$_SESSION['err_gender'] = "";
$_SESSION['name'] = $name;
$_SESSION['email'] = $email;
$_SESSION['contact'] = $contact;
$_SESSION['gender'] = $gender;

if(emailExists($email)) {
    $_SESSION['err_email'] = "Email already exists!";
    $isValid = false;
}

if (empty($name)) {
    $_SESSION['err_name'] = "Name is required.";
    $isValid = false;
}

if (empty($email)) {
    $_SESSION['err_email'] = "Email is required.";
    $isValid = false;
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['err_email'] = "Invalid email format.";
    $isValid = false;
}

if (empty($password)) {
    $_SESSION['err_password'] = "Password is required.";
    $isValid = false;
}

if (empty($confirmPassword)) {
    $_SESSION['err_confirm_password'] = "Please confirm your password.";
    $isValid = false;
} elseif ($password !== $confirmPassword) {
    $_SESSION['err_confirm_password'] = "Passwords do not match.";
    $isValid = false;
}

if (empty($contact)) {
    $_SESSION['err_contact'] = "Contact number is required.";
    $isValid = false;
} elseif (!preg_match('/^\d{1,13}$/', $contact)) {
    $_SESSION['err_contact'] = "Contact number must be less than 14 digits.";
    $isValid = false;
}

if (empty($gender)) {
    $_SESSION['err_gender'] = "Gender is required.";
    $isValid = false;
}

if ($isValid) {
    $registrationSuccessful = registerUser($name, $email, $password, $confirmPassword, $contact, $gender);

    if ($registrationSuccessful) {
        $_SESSION['success'] = "Registration successful!";
        header("Location: ../View/Login.php");
        exit();
    } else {
        $_SESSION['err_global'] = "Registration failed. Please try again.";
        header("Location: ../View/Registration.php");
        exit();
    }
} else {
    header("Location: ../View/Registration.php");
    exit();
}

function sanitize($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
