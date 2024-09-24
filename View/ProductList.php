<?php
session_start();
require "../Model/User.php"; 
require '../Model/Database.php'; 

// Check if the database connection was successful
if ($conn === null) {
    die("Database connection failed.");
}

// Handle form submission to add an item
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addItem'])) {
    // Check if 'item' and 'bill' are set in the POST request
    if (isset($_POST['item']) && isset($_POST['bill'])) {
        $item = sanitize($_POST['item']);
        $bill = sanitize($_POST['bill']);

        if (!empty($item) && !empty($bill)) {
            // Insert item into the database
            $stmt = $conn->prepare("INSERT INTO productlist (item, bill) VALUES (?, ?)"); // Ensure correct column names
            $stmt->bind_param("sd", $item, $bill); // 's' for string, 'd' for double (for decimal)
            
            if ($stmt->execute()) {
                echo "Item added successfully.";
            } else {
                echo "Error adding item: " . $stmt->error;
            }
            $result = $conn->query("SELECT product_name, bill FROM productlist");
            
            $stmt->close();
        } else {
            echo "Error: 'item' and 'bill' must be provided.";
        }
    }
}

// Handle item removal
if (isset($_GET['remove'])) {
    $id = intval($_GET['remove']);
    // Remove the item from the database
    $stmt = $conn->prepare("DELETE FROM productlist WHERE id = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        echo "Item removed successfully.";
    } else {
        echo "Error removing item: " . $stmt->error;
    }
    
}

// Query to get items
//$result = $conn->query("SELECT product_name, bill FROM productlist");

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
        <input type="number" step="0.01" name="bill" placeholder="Enter bill amount" required> <!-- Bill input -->
        <button type="submit" name="addItem">Add Item</button>
    </form>

    <h2>Items:</h2>
    <ul>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <li>
                    <?php echo htmlspecialchars($row['product_name']); ?>
                    <span><?php echo htmlspecialchars($row['bill']); ?></span> <!-- Display bill amount -->
                    <a href="?remove=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure you want to remove this item?');">Remove</a>
                </li>
            <?php endwhile; ?>
        <?php else: ?>
            <li>No items found.</li>
        <?php endif; ?>
    </ul>

    <div>
        <button onclick="location.href='Home.php'">Home</button>
        <button onclick="location.href='Profile.php'">Profile</button>
        <button onclick="location.href='Logout.php'">Logout</button>
    </div>

    <?php
    // Close the database connection only after all operations are done
    $conn->close(); 
    ?>
</body>
</html>
