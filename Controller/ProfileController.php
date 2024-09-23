<?php 
session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: Login.php");
    exit();
}

require "../Model/User.php";

$email = $_SESSION['email'];
$userProfile = getUserProfile($email);
$_SESSION['error'] = "";

function sanitize($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

if (!$userProfile) {
    echo "<p>User profile could not be retrieved.</p>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateField'])) {
    $fieldToUpdate = $_POST['updateField'];
    $updateSuccess = false;

    if ($fieldToUpdate === 'name') {
        $newName = sanitize($_POST['newName']);
        if (!empty($newName)) {
            $updateSuccess = updateProfile($newName, $email, null, null);
        } else {
            $_SESSION['error'] = "Name is required.";
        }
    } elseif ($fieldToUpdate === 'contact') {
        $newContact = sanitize($_POST['newContact']);
        if (!empty($newContact)) {
            $updateSuccess = updateProfile(null, $email, $newContact, null);
        } else {
            $_SESSION['error'] = "Contact number is required.";
        }
    } elseif ($fieldToUpdate === 'gender') {
        $newGender = sanitize($_POST['gender']);
        if (!empty($newGender)) {
            $updateSuccess = updateProfile(null, $email, null, $newGender);
        } else {
            $_SESSION['error'] = "Gender is required.";
        }
    }

    if ($updateSuccess) {
        $_SESSION['success'] = "Profile updated successfully!";
        header("Location: ../View/Profile.php");
    } else {
        $_SESSION['error'] = "Failed to update. Please try again.";
        header("Location: ../View/ProfileUpdate.php");
    }
} else {
    header("Location: ../View/ProfileUpdate.php");
}
?>
