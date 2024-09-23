<?php 
session_start(); 

if (empty($_SESSION['isLoggedIn'])) {
    $_SESSION['err3'] = "Unauthorized Access!";
    header("Location: Login.php");
    die();
} elseif ($_SESSION['isLoggedIn'] === false) {
    $_SESSION['err3'] = "Unauthorized Access!";
    header("Location: Login.php");
    die();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Shop</title>
    <link rel="stylesheet" type="text/css" href="homeStyle.css">
</head>
<body>
    <h1>Hello, <?php echo htmlspecialchars($_SESSION['email']); ?></h1>
    <hr>  
    <div class="menu">
        <button type="button"><a href="ProductList.php">Shop</a></button>
        <button type="button"><a href="Profile.php">Profile</a></button>
        <button type="button"><a href="ChangePassword.php">Change Password</a></button>
        <button type="button"><a href="../Controller/Logout.php">Logout</a></button>
    </div>
</body>
</html>
