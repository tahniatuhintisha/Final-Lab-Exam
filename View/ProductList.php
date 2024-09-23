<?php
session_start();

// Initialize the shopping list if not set
if (!isset($_SESSION['shopList'])) {
    $_SESSION['shopList'] = [];
}

// Handle form submission for adding an item
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addItem'])) {
    $item = sanitize($_POST['item']);
    if (!empty($item)) {
        $_SESSION['shopList'][] = $item; // Add item to the list
    }
}

// Handle removing an item
if (isset($_GET['remove'])) {
    $index = intval($_GET['remove']);
    if (isset($_SESSION['shopList'][$index])) {
        unset($_SESSION['shopList'][$index]); // Remove item from the list
        $_SESSION['shopList'] = array_values($_SESSION['shopList']); // Re-index the array
    }
}

// Sanitize function to clean user input
function sanitize($data) {
    return htmlspecialchars(trim($data));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop List</title>
    <link rel="stylesheet" href="style.css"> <!-- Optional CSS for styling -->
</head>
<body>
    <h1>My Shopping List</h1>

    <!-- Form to add a new item -->
    <form method="post" action="">
        <input type="text" name="item" placeholder="Enter item name" required>
        <button type="submit" name="addItem">Add Item</button>
    </form>

    <h2>Items:</h2>
    <ul>
        <?php foreach ($_SESSION['shopList'] as $index => $item): ?>
            <li>
                <?php echo htmlspecialchars($item); ?>
                <a href="?remove=<?php echo $index; ?>">Remove</a>
            </li>
        <?php endforeach; ?>
    </ul>

    <div>
        <button onclick="location.href='Home.php'">Home</button>
        <button onclick="location.href='Profile.php'">Profile</button>
        <button onclick="location.href='Logout.php'">Logout</button>
    </div>
</body>
</html>
