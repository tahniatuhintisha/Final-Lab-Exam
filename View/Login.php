<?php 
session_start();
?>                                                                                                                                                     
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="post" action="../Controller/LoginController.php" novalidate>
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>">
        <span><?php echo isset($_SESSION['err1']) ? htmlspecialchars($_SESSION['err1']) : '' ?></span>
        <br><br>
        <label for="password">Password</label>
        <input type="password" id="password" name="password" value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : '' ?>">
        <span><?php echo isset($_SESSION['err2']) ? htmlspecialchars($_SESSION['err2']) : '' ?></span>
        <br><br>
        <input type="submit" value="Login"><br>
    </form>

    <form method="post" action="../View/Registration.php" novalidate>
        <label>New in this web? Please register! </label><br>
    	<input type="submit" value="Registration">
    <from>

    <span><?php echo isset($_SESSION['err3']) ? htmlspecialchars($_SESSION['err3']) : '' ?></span>
</body>
</html>
