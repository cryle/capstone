<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../index.php');
  exit();
}

include "../auth/conn.php";
?>

<!DOCTYPE html>
<html>

<head>
  <title>Admin | View Findings</title>
  <link rel="stylesheet" href="../includes/style.css">
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body class="viewfindings">
  <div class="parent">
    <div class="child header">
      <h3>Patient Findings</h3>
    </div>
    <div class="main">
      <div class="child">
        <div class="container">
          <div class="logo">
            <!-- ADD LOGO -->
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
        <div>
          <header>
            <div>
              <!-- <a class="back" href="viewpatient.php?id=<?= $_SESSION['id'] ?>">Back</a> -->
            </div>
          </header>
          <div id="div-to-print" class="printable">
            <div class="findings view-findings">
              <?php
              if (isset($_GET['id_no'])) {
                $id_no = $_GET['id_no'];

                $sql = "SELECT * FROM patient_record WHERE id_no = $id_no";
                $result = $conn->query($sql);
                $row = mysqli_fetch_array($result);

              ?>
                <div class="report-patient-details findings-margin">
                  <h3>Patient Details</h3>
                  <div class="patient-details">
                    <div class="details-container">
                      <div>
                        <p class="title">PATIENT NAME: </p>
                        <p class="title-value"><?php echo $row['pr_lname'], ', ', $row['pr_fname'], ' ', $row['pr_mname'] ?></p>
                      </div>
                      <div>
                        <p class="title">GENDER:</p>
                        <p class="title-value"><?php echo $row['pr_gender'] ?></p>
                      </div>
                      <div>
                        <p class="title">AGE:</p>
                        <p class="title-value"><?php echo $row['pr_age'] ?></p>
                      </div>
                      <div>
                        <p class="title">BIRTHDATE:</p>
                        <p class="title-value"><?php echo $row['pr_bdate'] ?></p>
                      </div>
                      <div>
                        <p class="title">GRADE & SECTION:</p>
                        <p class="title-value"><?php echo $row['pr_grade'], ' - ', $row['pr_section'], ' ', ($row['pr_strand'] !== '') ?   '(' . $row['pr_strand'] . ')' : ''  ?></p>
                      </div>
                      <div>
                        <p class="title">SCHOOL ID NO.</p>
                        <p class="title-value"><?php echo $row['id_no']  ?></p>
                      </div>

                    </div>
                    <div class="details-container">
                      <div>
                        <p class="title">PROVINCE:</p>
                        <p class="title-value"><?php echo $row['pr_province'] ?></p>
                      </div>
                      <div>
                        <p class="title">CITY:</p>
                        <p class="title-value"><?php echo $row['pr_city'] ?></p>
                      </div>
                      <div>
                        <p class="title">BARANGAY:</p>
                        <p class="title-value"><?php echo $row['pr_barangay'] ?></p>
                      </div>
                      <div>
                        <p class="title">BLK & LOT:</p>
                        <p class="title-value"><?php echo $row['pr_addrs']  ?></p>
                      </div>
                    </div>
                    <div class="details-container">
                      <div>
                        <p class="title">CONTACT NO.</p>
                        <p class="title-value"><?php echo $row['pr_contact_no'] ?></p>
                      </div>
                      <div>
                        <p class="title">GUARDIAN'S CONTACT NO.</p>
                        <p class="title-value"><?php echo $row['pr_guardians_no'] ?></p>
                      </div>


                    </div>
                  </div>
                </div>

              <?php
              }
              ?>

              <?php

              if (isset($_GET['f_id'])) {
                $f_id = $_GET['f_id'];

                $sql = "SELECT * FROM findings WHERE f_id = $f_id ";
                $result = $conn->query($sql);
                $row = mysqli_fetch_array($result);

              ?>
                <div class="findings-page">
                  <div class="report-patient-details findings">
                    <div class="patient-details">
                      <h3>Findings</h3>
                      <h5><?php echo $row['f_date'] ?></h5>
                      <div class="details-container">
                        <div>
                          <p class="title">Chief Complaint: </p>
                          <p class="title-value"><?php echo $row['f_chief_complaint'] ?></p>
                        </div>
                        <div>
                          <p class="title">Physical Exam: </p>
                          <p class="title-value"><?php echo $row['f_physical_exam'] ?></p>
                        </div>
                        <div>
                          <p class="title">Diagnosis: </p>
                          <p class="title-value"><?php echo $row['f_diagnosis'] ?></p>
                        </div>
                        <div>
                          <p class="title">TREATMENT/MEDICATION: </p>
                          <p class="title-value"><?php echo $row['f_med'] ?></p>
                        </div>
                      </div>
                      <h4>Vital Signs</h4>
                      <div class="details-container">
                        <div>
                          <p class="title">Blood Pressure: </p>
                          <p class="title-value"><?php echo $row['f_bp'] ?></p>
                        </div>
                        <div>
                          <p class="title">RESPIRATORY RATE: </p>
                          <p class="title-value"><?php echo $row['f_rr'] ?></p>
                        </div>
                        <div>
                          <p class="title">TEMPERATURE: </p>
                          <p class="title-value"><?php echo $row['f_temp'] ?></p>
                        </div>
                        <div>
                          <p class="title">WEIGHT: </p>
                          <p class="title-value"><?php echo $row['f_wt'] ?></p>
                        </div>
                        <div>
                          <p class="title">PULSE RATE: </p>
                          <p class="title-value"><?php echo $row['f_pr'] ?></p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>