<?php 
session_start();
?>                                                                                                                                 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="jsValidation.js" defer></script>
</head>
<body>
    <form method="post" action="../Controller/RegisterController.php" novalidate>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : '' ?>">
        <span id="nameError"><?php echo isset($_SESSION['err_name']) ? htmlspecialchars($_SESSION['err_name']) : '' ?></span>
        <br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?>">
        <span id="emailError"><?php echo isset($_SESSION['err_email']) ? htmlspecialchars($_SESSION['err_email']) : '' ?></span>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : '' ?>">
        <span id="passwordError"><?php echo isset($_SESSION['err_password']) ? htmlspecialchars($_SESSION['err_password']) : '' ?></span>
        <br><br>
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirmPassword" value="<?php echo isset($_SESSION['confirmPassword']) ? htmlspecialchars($_SESSION['confirmPassword']) : '' ?>">
        <span id="confirmPasswordError"><?php echo isset($_SESSION['err_confirm_password']) ? htmlspecialchars($_SESSION['err_confirm_password']) : '' ?></span>
        <br><br>
        <label for="contact">Contact Number:</label>
        <input type="text" id="contact" name="contact" value="<?php echo isset($_SESSION['contact']) ? htmlspecialchars($_SESSION['contact']) : '' ?>">
        <span id="contactError"><?php echo isset($_SESSION['err_contact']) ? htmlspecialchars($_SESSION['err_contact']) : '' ?></span>
        <br><br>
        <label>Gender:</label><br>
        <input type="radio" id="male" name="gender" value="Male" <?php echo isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male' ? 'checked' : '' ?>>
        <label for="male">Male</label><br>
        <input type="radio" id="female" name="gender" value="Female" <?php echo isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female' ? 'checked' : '' ?>>
        <label for="female">Female</label>
        <span id="genderError"><?php echo isset($_SESSION['err_gender']) ? htmlspecialchars($_SESSION['err_gender']) : '' ?></span>
        <br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
