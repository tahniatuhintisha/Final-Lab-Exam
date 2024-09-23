<?php
function matchCredentials($email, $password) {
    $conn = mysqli_connect("localhost", "root", "", "RegistrationJs");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "SELECT email FROM registeredinfo WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        mysqli_close($conn);
        return true; // Credentials match
    }

    mysqli_close($conn);
    return false; // Credentials don't match
}

function checkOldPassword($email, $oldPassword) {
    $conn = mysqli_connect("localhost", "root", "", "RegistrationJs");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT password FROM registeredinfo WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if ($row['password'] === $oldPassword) {
            mysqli_close($conn);
            return true; 
        }
    }

    mysqli_close($conn);
    return false; 
}

function updatePassword($email, $newPassword) {
    $conn = mysqli_connect("localhost", "root", "", "RegistrationJs");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "UPDATE registeredinfo SET password = '$newPassword' WHERE email = '$email'";
    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true; 
    }

    mysqli_close($conn);
    return false; 
}

function getUserProfile($email) {
    $conn = mysqli_connect("localhost", "root", "", "RegistrationJs");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT name, email, contact, gender FROM registeredinfo WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        mysqli_close($conn);
        return $row; 
    }

    mysqli_close($conn);
    return false; 
}

function registerUser($name, $email, $password, $confirmPassword, $contact, $gender) {
    
    $servername = "localhost";
    $dbuser = "root";
    $dbpassword = "";
    $dbname = "RegistrationJs"; // Adjust this to your actual database name

    $conn = new mysqli($servername, $dbuser, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM registeredinfo WHERE email = ?");
    $stmt->bind_param("s", $email);

   
    if ($stmt->execute()) {
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $stmt->close();
            $conn->close();
            return false;
        } else {
            if ($password === $confirmPassword) {

                $stmt = $conn->prepare("INSERT INTO registeredinfo (name, email, password, confirmPassword, contact, gender) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssis", $name, $email, $password, $confirmPassword, $contact, $gender);

                if ($stmt->execute()) {
                    $stmt->close();
                    $conn->close();
                    return true;
                } else {
                    $stmt->close();
                    $conn->close();
                    return false;
                }
            } else {
                $stmt->close();
                $conn->close();
                return false;
            }
        }
    } else {
        // Error executing query
        $stmt->close();
        $conn->close();
        return false;
    }
}

function emailExists($email) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "RegistrationJs"; // Adjust this to your actual database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $email = $conn->real_escape_string(trim($email));
    $sql = "SELECT email FROM registeredinfo WHERE email = '$email'";
    $result = $conn->query($sql);
    $conn->close();
    return $result && $result->num_rows > 0;
}

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if (emailExists($email)) {
        echo "Email already exists";
    } else {
        echo "Email is available";
    }
}

function updateProfile($name = null, $email, $contact = null, $gender = null) {
    $conn = mysqli_connect("localhost", "root", "", "RegistrationJs");
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $setClauses = [];
    
    if ($name !== null) {
        $name = mysqli_real_escape_string($conn, $newName);
        $setClauses[] = "name = '$newName'";
    }
    
    if ($contact !== null) {
        $contact = mysqli_real_escape_string($conn, $newContact);
        $setClauses[] = "contact = '$newContact'";
    }
    
    if ($gender !== null) {
        $gender = mysqli_real_escape_string($conn, $newGender);
        $setClauses[] = "gender = '$newGender'";
    }

    $setClauseString = implode(", ", $setClauses);
    $sql = "UPDATE registeredinfo SET $setClauseString WHERE email = '$email'";

    if (mysqli_query($conn, $sql)) {
        mysqli_close($conn);
        return true; 
    }

    mysqli_close($conn);
    return false; 
}
function ProductList($item){
$conn = mysqli_connect("localhost", "root", "", "RegistrationJs");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind
if ($_SERVER["REQUEST_METHOD"] == "POST" && emailExists($email)) {
    $product_name = $_POST['item'];

    $stmt = $conn->prepare("INSERT INTO productlist item VALUES (?)");
    $stmt->bind_param("s", $product_name);

    if ($stmt->execute()) {
        echo "New product added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();


}
?>
