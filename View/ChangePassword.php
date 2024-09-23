<?php
session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: Login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <script type="text/javascript" src="jsValidation.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Change Password</h1>

<form method="post" action="../Controller/ChangePasswordController.php">
    <label for="oldPassword">Old Password</label>
    <input type="password" id="oldPassword" name="oldPassword">
    <br><br>

    <label for="newPassword">New Password</label>
    <input type="password" id="newPassword" name="newPassword">
    <br><br>

    <label for="confirmPassword">Confirm New Password</label>
    <input type="password" id="confirmPassword" name="confirmPassword">
    <br><br>

    <input type="submit" value="Change Password">
</form>

<?php
if (!empty($_SESSION['error'])) {
    echo "<p style='color:red'>" . $_SESSION['error'] . "</p>";
    unset($_SESSION['error']);
}
if (!empty($_SESSION['success'])) {
    echo "<p style='color:green'>" . $_SESSION['success'] . "</p>";
    unset($_SESSION['success']);
}
?>

<a href="Profile.php">Back to Profile</a>

</body>
</html>
