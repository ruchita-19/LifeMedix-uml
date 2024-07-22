<?php
session_start();
$conn = new mysqli("localhost", "root", "", "umlproject");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_SESSION['username'];
$query = "SELECT PatientID FROM patient WHERE username = '$name';";
$patient = $conn->query($query);
$patientid = mysqli_fetch_assoc($patient);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/appointment.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Appointment Form</title>
</head>

<body>
    <header>
        <nav>
            <img src="../images/LOGO.svg" alt="Logo">
            <ul class="menu">
                <li><a href="#" class="links">Home</a></li>
                <li><a href="../cart/cart/shop.html" class="links">Shop</a></li>
                <li><a href="appointment.php" class="links">Consult a Doctor</a></li>
                <li id="profile-icon">
                    <a href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0z"></path><path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13Z"></path></svg></a>
                </li>
            </ul>
        </nav>
    </header>

    <section class="appointment-hero">
        <div class="appointment-left">
            <div class="container">
                <form method="post">
                    <div class="form-group">
                        <label for="patientid">Patient</label>
                        <input type="text" class="form-control" id="patientid" placeholder="<?php echo $patientid['PatientID']; ?>" name="patientid" disabled>
                        <small id="emailHelp" class="form-text text-muted">This is the ID associated with your username</small>
                    </div>
                    <div class="form-group">
                        <label for="PatientFullName">Patient Name</label>
                        <input type="text" class="form-control" id="PatientFullName" placeholder="Enter Patient's full name" name="PatientFullName">
                    </div>
                    <div class="date_time">
                        <label for="datepicker">Select Date:</label>
                        <input type="date" id="datepicker" name="datepicker">
                        <br>
                        <label for="timepicker" style="margin-top:5px;">Select Time:</label>
                        <input type="time" id="timepicker" name="timepicker">
                    </div>

                    <div class="input-group">
                        <select class="custom-select" id="inputGroupSelect04" name="speciality">
                            <option selected>Choose a specialty...</option>
                            <option value="Orthopedic Surgeon">Orthopedic Surgeon - Bones and musculoskeletal system</option>
                            <option value="Pediatrician">Pediatrician - Children's healthcare</option>
                            <option value="Cardiologist">Cardiologist - Heart and cardiovascular system</option>
                            <option value="Dermatologist">Dermatologist - Skin health and diseases</option>
                            <option value="Neurologist">Neurologist - Nervous system and brain disorders</option>
                            <option value="Gastroenterologist">Gastroenterologist - Digestive system disorders</option>
                            <option value="Ophthalmologist">Ophthalmologist - Eye care and vision disorders</option>
                            <option value="Psychiatrist">Psychiatrist - Mental health and emotional well-being</option>
                            <option value="Endocrinologist">Endocrinologist - Hormone-related disorders, including diabetes</option>
                        </select>

                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit" name="check" id="check">Check</button>
                        </div>
                        <?php
                        if (isset($_POST['check'])) {
                            $selectedSpeciality = $_POST['speciality'];

                            $query = "SELECT * FROM doctors WHERE Specialization = ?";
                            $stmt = $conn->prepare($query);
                            $stmt->bind_param("s", $selectedSpeciality);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            if ($result) {
                                echo '<small id="emailHelp" class="form-text text-muted">Speciality: ' . htmlspecialchars($selectedSpeciality, ENT_QUOTES, 'UTF-8') . '</small>';

                                echo '<div class="input-group">';
                                echo '<select class="form-select" aria-label="Default select example" id="DoctorSelected" name="DoctorSelected">';

                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['DoctorID'] . '">' . htmlspecialchars($row['FirstName'] . $row['LastName'], ENT_QUOTES, 'UTF-8') . '</option>';
                                }

                                echo '</select></div>';
                            } else {
                                die("Error in query: " . $conn->error);
                            }
                        }
                        ?>
                    </div>
                    <div class="form-floating">
                        <textarea class="form-control" id="description" name="description"></textarea>
                        <label for="description">Describe your illness</label>
                    </div>

                    <button type="submit" class="btn btn-primary" id="submit" name="submit">Submit</button>

                    <?php
                    if (isset($_POST['submit'])) {
                        $date = $_POST['datepicker'];
                        $time = $_POST['timepicker'];
                        $doctorID = $_POST['DoctorSelected'];
                        $patientfullname = $_POST['PatientFullName'];
                        $dateTime = $date . ' ' . $time;
                        $description = $_POST['description'];

                        $insertQuery = "INSERT INTO appointments (PatientID, PatientFullName, DoctorID, AppointmentDate, Notes) VALUES ('" . $patientid['PatientID'] . "', '" . $patientfullname . "', '" . $doctorID . "', '" . $dateTime . "','" . $description . "')";
                        $appointment =mysqli_query($conn,$insertQuery);
                        if($appointment){
                            echo "<script>alert('Appointment Booked');</script>";
                        }
                    }
                    ?>
                </form>
            </div>
        </div>
        <div class="appointment-right">
            <img src="../images/doctors.svg" alt="book an appointment">
        </div>
    </section>
    
    
</body>

</html>
