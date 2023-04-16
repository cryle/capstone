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
   <title>Admin | View Patient Details</title>
   <link rel="stylesheet" href="../includes/style.css">
   <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body class="viewpatient">
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
            <div class="records-div printable">
               <header class="header-div">
                  <h1 class="patient-header">Patient Records</h1>
                  <div>
                     <!-- <a class="details-back" href="./patientrecords.php">Back</a> -->
                  </div>
                  <div class="patientdetails">
                     <?php
                     if (isset($_GET['id'])) {
                        $id_no = $_GET['id'];
                        $_SESSION["id"] = $_GET['id'];
                        $sql = "SELECT * FROM patient_record WHERE id_no = $id_no";
                        $result = mysqli_query($conn, $sql);
                        $row = mysqli_fetch_array($result);
                     ?>
                        <div class="details">
                           <p>PATIENT NAME:</p>
                           <div class="patient_name">
                              <h3><?php echo $row['pr_lname'], ', ' ?></h3>
                              <h3><?php echo $row['pr_fname']; ?></h3>
                              <h3><?php echo $row['pr_mname']; ?></h3>
                           </div>
                        </div>
                        <div class="caseno">
                           <p class="no">Case No.</p>
                           <h3><?php echo $_SESSION['id']; ?></h3>
                        </div>
                     <?php
                     }
                     ?>
               </header>
            </div>

            <div class="details-container printable">
               <div class="patient-details-div">
                  <h3>Details</h3>

                  <div class="title-container hide-name">
                     <label>Fullname</label>
                     <div class="details-div">
                        <span><?php echo $row['pr_lname'], ', ', $row['pr_fname'], ' ', $row['pr_mname'] ?></span>
                     </div>
                  </div>

                  <div class="title-container">
                     <label>Address</label>
                     <div class="details-div">
                        <span><?php echo $row['pr_province'], ', ', $row['pr_city'], ', ', $row['pr_barangay'], ', ', $row['pr_addrs']  ?></span>
                     </div>
                  </div>

                  <div class="title-container">
                     <label>Age</label>
                     <div class="details-div">
                        <span><?php echo $row['pr_age'] ?></span>
                     </div>
                  </div>

                  <div class="title-container">
                     <label>Birthday</label>
                     <div class="details-div">
                        <span><?php echo $row['pr_bdate'] ?></span>
                     </div>
                  </div>

                  <div class="title-container">
                     <label>Gender</label>
                     <div class="details-div">
                        <span><?php echo $row['pr_gender'] ?></span>
                     </div>
                  </div>

                  <div class="title-container">
                     <label>Contact No.</label>
                     <div class="details-div">
                        <span><?php echo $row['pr_contact_no'] ?></span>
                     </div>
                  </div>

                  <div class="title-container">
                     <label>Guardian's Contact No.</label>
                     <div class="details-div">
                        <span><?php echo $row['pr_guardians_no'] ?></span>
                     </div>
                  </div>

                  <div class="title-container">
                     <label>Grade & Section</label>
                     <div class="details-div">
                        <span><?php echo $row['pr_grade'], ' - ', $row['pr_section'], ' ', ($row['pr_strand'] !== '') ?   '(' . $row['pr_strand'] . ')' : ''  ?></span>
                     </div>
                  </div>


                  <div class="history">
                     <h3>OPD Findings</h3>
                     <main class="table2">
                        <section class="table__body">
                           <table>
                              <thead>
                                 <tr>
                                    <th>History of Present Illness</th>
                                    <th>Date Consulted</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php

                                 if (isset($_GET['id'])) {
                                    $id_no = $_GET['id'];

                                    $sql = "SELECT * FROM findings WHERE p_id_no = $id_no";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                       while ($row = $result->fetch_assoc()) {
                                          $p_id_no = $row['p_id_no'];
                                          $f_id = $row['f_id'];
                                          $pr_findings_id = $row['pr_findings_id'];
                                          $f_diagnosis = $row['f_diagnosis'];
                                          $f_date = $row['f_date'];

                                          echo '
            <tr>
    <td><a href="viewfindings.php?f_id=' . $f_id . '&id_no=' . $id_no . '">' . $f_diagnosis . '</a></td>
    <td>' . $f_date . '</td>
  </tr>
     ';
                                       }
                                    }
                                 }
                                 ?>
                              </tbody>
                           </table>
                        </section>
                     </main>
                  </div>


               </div>
            </div>
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