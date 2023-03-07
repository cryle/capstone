<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../index.php');
  exit();
}

include '../auth/conn.php';

if (isset($_POST['submit'])) {
  $pr_fname = $_POST['pr_fname'];
  $pr_lname = $_POST['pr_lname'];
  $pr_mname = $_POST['pr_mname'];
  $pr_grade_section = $_POST['pr_grade_section'];
  $pr_gender = $_POST['pr_gender'];
  $pr_age = $_POST['pr_age'];
  $pr_addrs = $_POST['pr_addrs'];
  $pr_bdate = $_POST['pr_bdate'];

  $sql = "INSERT INTO patient_record (pr_fname, pr_lname, pr_mname, pr_gender, pr_grade_section, pr_age, pr_addrs, pr_bdate)
			VALUES ('$pr_fname', '$pr_lname', '$pr_mname', '$pr_gender', '$pr_grade_section', '$pr_age', '$pr_addrs', '$pr_bdate')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    header("Location: ./patientrecords.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../includes/style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Admin | Add Patient Record</title>
</head>

<body class="dark-mode">
  <div class="parent">
    <div class="child header">
      <p>Add Patient Record</p>
    </div>
    <div class="main">
      <div class="child">
        <div class="container">
          <div class="logo">
          </div>
          <nav>
            <ul class="link-items">
              <li class="link-item">
                <a href="./home.php" class="link">
                  <ion-icon name="home-outline"></ion-icon>
                  <span>Home</span>
                </a>
              </li>
              <li class="link-item">
                <a href="./patientrecords.php" class="link">
                  <ion-icon name="person-outline"></ion-icon>
                  <span>Patient Records</span>
                </a>
              </li>
              <li class="link-item active">
                <a href="./addpatientrecord.php" class="link">
                  <ion-icon name="file-tray-full-outline"></ion-icon>
                  <span>Add Patient</span>
                </a>
              </li>
              <li class="link-item">
                <a href="./addfindings.php" class="link">
                  <ion-icon name="medkit-outline"></ion-icon>
                  <span>Add Findings</span>
                </a>
              </li>
              <li class="link-item">
                <a href="./add_user.php" class="link">
                  <ion-icon name="person-add-outline"></ion-icon>
                  <span>Add User</span>
                </a>
              </li>
              <li class="link-item user">
                <a href="./logout.php" class="link">
                  <img src="../public/winter.jpg" alt="user-icon">
                  <span>
                    <h4><?= $_SESSION['username'] ?></h4>
                    <p><?= $_SESSION['role'] ?></p>
                  </span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="child content">
        <div class="addpatientform">
          <form action="" method="POST" style="color: white;">
            <div>
              <label for="pr_fname">Firstname</label>
              <input type="text" name="pr_fname">
            </div>
            <div>
              <label for="pr_lname">Lastname</label>
              <input type="text" name="pr_lname">
            </div>
            <div>
              <label for="pr_mname">Middle Initial</label>
              <input type="text" name="pr_mname">
            </div>
            <div>
              <label for="pr_grade_section">Grade & Section</label>
              <input type="text" name="pr_grade_section">
            </div>
            <div>
              <label for="pr_gender">Gender</label>
              <select name="pr_gender">
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div>
              <label for="pr_age">Age</label>
              <input type="text" name="pr_age">
            </div>
            <div>
              <label for="pr_addrs">Address</label>
              <input type="text" name="pr_addrs">
            </div>
            <div>
              <label for="pr_bdate">Birthdate</label>
              <input type="date" name="pr_bdate">
            </div>
            <input type="submit" name="submit" value="Submit">
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>