<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password =$_POST["password"];
    $phoneno = $_POST["phonenumber"];
    
    // Connect to the database
    $conn = new mysqli("localhost", "root", "", "umlproject");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = "INSERT INTO userdata (username, email, password,phonenumber) VALUES ('$username', '$email', '$password','$phoneno')";
    $sql2 = "INSERT INTO patient (username,Updated) VALUES ('$username', 0)";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $insert= mysqli_query($conn,$sql2);
    $conn->close();
}
?>
