<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "umlproject");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Query the database for the user
    $sql = "SELECT username, password,email FROM userdata WHERE username='$username'";
    $result = $conn->query($sql);
    
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
       
        if ($password === $row["password"]) {
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["email"] =$row['email'];
            header("Location: profile.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
    
    $conn->close();
}
?>
