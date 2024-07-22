<?php
session_start();

$conn = new mysqli("localhost", "root", "", "umlproject");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name=$_SESSION['username'];
    $sql = "SELECT username, email,phonenumber FROM userdata WHERE username = '$name'";
    $result = $conn->query($sql);
    
   
if ($result->num_rows === 1) {
    $userDetails = $result->fetch_assoc();
}



?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/profile.css">
    <link rel="stylesheet" href="../css/header.css">
    <title>Document</title>
</head>
<body>
    <header>
        <nav>
            <img src="../images/LOGO.svg" alt="Logo">
            <ul class="menu">
                <li><a href="#" class="links">Home</a></li>
                <li><a href="../cart/cart/shop.html" class="links">Shop</a></li>
                <li><a href="../php/appointment.php" class="links">Consult a Doctor</a></li>
                <li id="profile-icon" style="cursor:pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" d="M0 0h24v24H0z"></path><path d="M4 22C4 17.5817 7.58172 14 12 14C16.4183 14 20 17.5817 20 22H4ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13Z"></path></svg>
                    </li>
            </ul>
        </nav>
    </header>
    <div class="dropdown">
        <span><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M6.41421 15.89L16.5563 5.74786L15.1421 4.33365L5 14.4758V15.89H6.41421ZM7.24264 17.89H3V13.6474L14.435 2.21233C14.8256 1.8218 15.4587 1.8218 15.8492 2.21233L18.6777 5.04075C19.0682 5.43128 19.0682 6.06444 18.6777 6.45497L7.24264 17.89ZM3 19.89H21V21.89H3V19.89Z"></path></svg></span>
        <a href="user_update.php">Update Profile</a>
    </div>

    <?php
     $patientquery = "SELECT PatientID,Patientname,Allergies,Gender,Age FROM patient WHERE username = '$name'";
     $patient = $conn->query($patientquery);
     $patientdetails= mysqli_fetch_assoc($patient);
     $appointmentsQuery = "SELECT * FROM appointments WHERE PatientID = '{$patientdetails['PatientID']}'";
    $appointmentsResult = $conn->query($appointmentsQuery);

     $conn->close();
     ?>
    <section class="medical-records">
        <h2>User Details</h2>
        <table>
            <thead> 
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Username</td>
                    <td><?php echo $userDetails['username']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $userDetails['email']; ?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td><?php echo $userDetails['phonenumber']; ?></td>
                </tr>
                <tr>
                    <td>PatientID</td>
                    <td><?php echo $patientdetails['PatientID']; ?></td>
                </tr>
                <tr>
                    <td>Patient Fullname</td>
                    <td><?php echo $patientdetails['Patientname']; ?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><?php echo $patientdetails['Gender']; ?></td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td><?php echo $patientdetails['Age']; ?></td>
                </tr>

            </tbody>
        </table>
    </section>
    <section class="appointments">
        <h2>User Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Patient Name</th>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Condition</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($appointmentsResult->num_rows > 0) {
                    while ($appointment = $appointmentsResult->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $appointment['PatientFullName'] . "</td>";
                        echo "<td>" . $appointment['DoctorID'] . "</td>";
                        echo "<td>" . $appointment['AppointmentDate'] . "</td>";                 
                        echo "<td>" . $appointment['Notes'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No appointments found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    
    <form method="post">
    <button type="submit" class="logout" name="logout">Logout</button>
    </form>
        <?php
        if (isset($_POST['logout'])) {
            session_destroy();
            header("Location: ../login.html");
            exit();
        }
        ?>
   <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const profile = document.getElementById('profile-icon');
        const dropdown = document.querySelector('.dropdown');
        let flag = false;

        profile.addEventListener('click', function() {
            if (!flag) {
                dropdown.style.display = 'block';
                flag = true;
            } else {
                dropdown.style.display = 'none';
                flag = false;
            }
        });
    });
</script>


</body>
</html>