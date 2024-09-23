<?php
session_start();

if (!isset($_SESSION['isLoggedIn']) || $_SESSION['isLoggedIn'] !== true) {
    header("Location: Login.php");
    exit();
}

require_once("../Model/User.php");

$email = $_SESSION['email']; 
$userProfile = getUserProfile($email);

if (!$userProfile) {
    echo "<p>User profile could not be retrieved.</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script type="text/javascript" src="jsValidation.js"></script>
    <link rel="stylesheet" href="homeStyle.css">
</head>
<body>

<h1><?php echo htmlspecialchars($userProfile['name']);?> Your Profile</h1>

<p><strong>Name:</strong> <?php echo htmlspecialchars($userProfile['name']); ?></p>
<p><strong>Email:</strong> <?php echo htmlspecialchars($userProfile['email']); ?></p>
<p><strong>Contact Number:</strong> <?php echo htmlspecialchars($userProfile['contact']); ?></p>
<p><strong>Gender:</strong> <?php echo htmlspecialchars($userProfile['gender']); ?></p>

<div class="menu">
    <button type="button"><a href="ChangePassword.php">Change Password</a><br></button>
    <button type="button"><a href="ProfileUpdate.php">Update Profile</a><br></button>
    <button type="button"><a href="Home.php">Home</a><br></button>
    <button type="button"><a href="../Controller/Logout.php">Logout</a></button>
</div>

</body>
</html>