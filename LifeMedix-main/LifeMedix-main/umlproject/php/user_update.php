<?php
session_start();
$conn = new mysqli("localhost", "root", "", "umlproject");
$name = $_SESSION['username'];
$email = $_SESSION['email'];

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Used to generate a unique id every time
if (!isset($_SESSION['uniqueID'])) {
    // Generate unique ID if not set
    $_SESSION['uniqueID'] = uniqid();
}
$uniqueID = $_SESSION['uniqueID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <form method="post">
            <div class="form-group">
                <label for="Username">Username</label>
                <input type="text" class="form-control" id="Username" name="Username" placeholder="<?php echo $name; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" placeholder="<?php echo $email; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="PatientID">PatientID</label>
                <!-- Use the value of $uniqueID directly, not from the form -->
                <input type="text" class="form-control" id="PatientID" name="PatientID" value="<?php echo $uniqueID; ?>" disabled>
            </div>
            <div class="form-group">
                <label for="fullname">Full Name</label>
                <input type="text" class="form-control" id="fullname" placeholder="Enter name" name="fullname" required>
                <small id="emailHelp" class="form-text text-muted">Please enter your first name followed by last name</small>
            </div>
            <div class="form-group">
                <label for="Allergies">Allergies</label>
                <textarea class="form-control" id="Allergies" rows="3" name="Allergies" required></textarea>
                <small id="emailHelp" class="form-text text-muted">Please enter any allergies separated by ","</small>
            </div>
            <label class="form-check-label">Gender:</label>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="male">
                <label class="form-check-label" for="inlineRadio1">Male</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="female">
                <label class="form-check-label" for="inlineRadio2">Female</label>
            </div>
            <div class="form-group form-group-inline">
                <label for="Age">Age</label>
                <input type="number" class="form-control" id="Age" placeholder="Enter age" name="Age" required>
            </div>

            <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {

        $patientID = $uniqueID;
        $user= $_POST['Username'];
        $fullname = $_POST['fullname'];
        $allergies = $_POST['Allergies'];
        $gender = $_POST['inlineRadioOptions'];
        $age = $_POST['Age'];

        $query = "SELECT Updated FROM patient WHERE username='$name';";
        $updationvalue = mysqli_query($conn, $query);
        $update = mysqli_fetch_assoc($updationvalue);
        if ($update['Updated'] == 1) {
            $updatequery = "UPDATE patient SET Patientname = '$fullname', Allergies = '$allergies', Gender = '$gender', Age = $age WHERE username='$name';";
            if (mysqli_query($conn, $updatequery)) {
                header("Location: profile.php");
            }
            $sql1= "UPDATE userdata set username='$user'; where username ='$name';";
            mysqli_query($conn,$sql1);
        } else {
            $sql = "UPDATE patient
            SET 
                PatientID = '$patientID',
                Patientname = '$fullname',
                Allergies = '$allergies',
                Gender = '$gender',
                Age = $age,
                Updated = 1
            WHERE  username= '$name';";


            if (mysqli_query($conn, $sql)) {
                echo "Details updated";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
            
        }
    }

    mysqli_close($conn);
    ?>
</body>
</html>
