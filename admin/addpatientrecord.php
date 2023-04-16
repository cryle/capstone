<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../index.php');
  exit();
}

include '../auth/conn.php';

if (isset($_POST['submit'])) {
  $id_no = $_POST['id_no'];

  $sql = "SELECT * FROM patient_record WHERE id_no = '$id_no'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $_SESSION['username_exist'] = true;
  } else {
    $id_no = $_POST['id_no'];
    $pr_fname = $_POST['pr_fname'];
    $pr_lname = $_POST['pr_lname'];
    $pr_contact_no = $_POST['pr_contact_no'];
    $pr_guardians_no = $_POST['pr_guardians_no'];
    $pr_grade = $_POST['pr_grade'];
    $pr_section = $_POST['pr_section'];
    $pr_strand = $_POST['pr_strand'];
    $pr_gender = $_POST['pr_gender'];
    $pr_province = $_POST['pr_province'];
    $pr_city = $_POST['pr_city'];
    $pr_barangay = $_POST['pr_barangay'];
    $pr_addrs = $_POST['pr_addrs'];
    $pr_bdate = $_POST['pr_bdate'];
    $birthdate = $_POST['pr_bdate'];
    $birthdate_timestamp = strtotime($birthdate);
    $current_timestamp = time();
    $difference_seconds = $current_timestamp - $birthdate_timestamp;
    $age = floor(date('Y', $difference_seconds) - 1970);

    $sql = "INSERT INTO patient_record (id_no, pr_lname, pr_fname, pr_contact_no, pr_guardians_no, pr_grade, pr_section, pr_strand, pr_gender, pr_age, pr_province, pr_city, pr_barangay, pr_addrs, pr_bdate)
      VALUES ('$id_no', '$pr_lname', '$pr_fname', '$pr_contact_no', '$pr_guardians_no', '$pr_grade', '$pr_section', '$pr_strand', '$pr_gender', '$age', '$pr_province', '$pr_city', '$pr_barangay', '$pr_addrs', '$pr_bdate')";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      header("Location: ./patientrecords.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
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
  <?php include 'script.js' ?>
  <title>Admin | Add Patient Record</title>
</head>

<body class="dark-mode">
  <div class="parent">
    <div class="child header">
      <span class="header-content">
        <a href="./logout.php">LOGOUT</a>
      </span>
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
              <li class="link-item">
                <a href="./reports.php" class="link">
                  <ion-icon name="person-add-outline"></ion-icon>
                  <span>Reports</span>
                </a>
              </li>
              <li class="link-item">
                <a href="./userrecords.php" class="link">
                  <ion-icon name="person-add-outline"></ion-icon>
                  <span>User Management</span>
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
        <div class="form-container">
          <div class="title">Add Patient Record</div>
          <form action="" method="POST">
            <span class="patient-title">Patient Details</span>
            <div class="id_error">
              <?php

              if (isset($_SESSION['username_exist'])) {
                echo "School ID No Already Exists";
                unset($_SESSION['username_exist']);
              }

              ?>
            </div>
            <div class="patient-details">
              <div class="input-box">
                <span class="form-details">School ID No.</span>
                <input type="text" name="id_no" placeholder="Enter School ID No." required>
              </div>
              <div class="input-box">
                <span class="form-details">Firstname</span>
                <input type="text" name="pr_fname" placeholder="Enter firstname" required>
              </div>
              <div class="input-box">
                <span class="form-details">Lastname</span>
                <input type="text" name="pr_lname" placeholder="Enter lastname" required>
              </div>
              <div class="input-box">
                <span class="form-details">Contact No.</span>
                <input type="text" name="pr_contact_no" placeholder="Enter contact number" required>
              </div>
              <div class="input-box">
                <span class="form-details">Guardian's Contact No.</span>
                <input type="text" name="pr_guardians_no" placeholder="Enter guardian's contact number" required>
              </div>
              <div class="input-box">
                <span class="form-details">Birthdate</span>
                <input type="date" name="pr_bdate" required>
              </div>
            </div>
            <div class="gender-details">
              <span class="gender-title">Grade & Section</span>
              <div class="category">
                <label>
                  <select name="pr_grade" class="add-select">
                    <option>Grade</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                  </select>
                </label>
                <label>
                  <select name="pr_section" class="add-select">
                    <option>Section</option>
                    <option value="Napier">Napier</option>
                    <option value="Wind">Wind</option>
                  </select>
                </label>
                <label>
                  <select name="pr_strand" class="add-select">
                    <option value="">Strand</option>
                    <option value="ICT">ICT</option>
                    <option value="STEM">STEM</option>
                  </select>
                </label>
              </div>
            </div>
            <div class="gender-details">
              <input type="radio" name="pr_gender" value="Male" id="dot-1">
              <input type="radio" name="pr_gender" value="Female" id="dot-2">
              <span class="gender-title">Gender</span>
              <div class="category">
                <label for="dot-1">
                  <span class="dot one"></span>
                  <span class="gender">Male</span>
                </label>
                <label for="dot-2">
                  <span class="dot two"></span>
                  <span class="gender">Female</span>
                </label>
              </div>
            </div>
            <div class="gender-details">
              <span class="gender-title">Address</span>
              <div class="category">
                <label>
                  <select class="add-select" name="pr_province" id="provinceSelect" onchange="populateCities()">
                    <option value="">Province</option>
                    <script>
                      for (var i = 0; i < provinceOptions.length; i++) {
                        var option = document.createElement("option");
                        option.value = provinceOptions[i];
                        option.text = provinceOptions[i];
                        document.getElementById("provinceSelect").add(option);
                      }
                    </script>
                  </select>
                  <select class="add-select" name="pr_city" id="citySelect" onchange="populateBarangays()">
                    <option value="">City</option>
                  </select>

                  <select class="add-select" name="pr_barangay" id="barangaySelect">
                    <option value="">Barangay</option>
                  </select>
                </label>
              </div>
            </div>
            <div class="patient-details">
              <div class="input-box">
                <span class="form-details">Street Name, Building, House No.</span>
                <input type="text" name="pr_addrs" placeholder="Street Name, Building, House No." required>
              </div>

              <div class="input-box addpatient">
                <input type="submit" value="Add Patient" name="submit">
              </div>
            </div>
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