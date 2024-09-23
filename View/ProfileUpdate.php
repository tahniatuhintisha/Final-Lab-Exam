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
    <h1><?php echo htmlspecialchars($userProfile['name']); ?> Your Profile</h1>
    
    <form method="post" action="../Controller/ProfileController.php">
        <div>
            <label for="newName">Name:</label>
            <input type="text" id="newName" name="newName" value="<?php echo isset($_SESSION['newName']) ? htmlspecialchars($_SESSION['newName']) : ''; ?>">
            <button type="submit" name="updateField" value="newName">Update</button>
        </div>
        <br>
        
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : ''; ?>" readonly>
            <br><br>
        </div>
        <br>

        <div>
            <label for="newContact">Contact Number:</label>
            <input type="text" id="newContact" name="newContact" value="<?php echo isset($_SESSION['newContact']) ? htmlspecialchars($_SESSION['newContact']) : ''; ?>">
            <button type="submit" name="updateField" value="newContact">Update</button>
        </div>
        <br>

        <div>
            <label>Gender:</label>
            <button type="submit" name="updateField" value="newGender">Update</button>
            <br>
            <input type="radio" id="male" name="gender" value="Male" <?php echo isset($_SESSION['newGender']) && $_SESSION['newGender'] == 'Male' ? 'checked' : '' ?>>
            <label for="male">Male</label><br>
            <input type="radio" id="female" name="gender" value="Female" <?php echo isset($_SESSION['newGender']) && $_SESSION['newGender'] == 'Female' ? 'checked' : '' ?>>
            <label for="female">Female</label>
        </div>
        <br>
    </form>
    
    <div>
        <button onclick="location.href='Home.php'">Home</button>
        <button onclick="location.href='Profile.php'">Profile</button>
        <button onclick="location.href='Logout.php'">Logout</button>
    </div>
</body>
</html>
