<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../index.php');
  exit();
}
include "../auth/conn.php";

if (isset($_POST['submit'])) {
  $pr_findings_id = $_POST['pr_findings_id'];
  $f_chief_complaint = $_POST['f_chief_complaint'];
  $f_physical_exam = $_POST['f_physical_exam'];
  $f_diagnosis = $_POST['f_diagnosis'];
  $f_bp = $_POST['f_bp'];
  $f_rr = $_POST['f_rr'];
  $f_cr = $_POST['f_cr'];
  $f_temp = $_POST['f_temp'];
  $f_wt = $_POST['f_wt'];
  $f_pr = $_POST['f_pr'];
  $f_med = $_POST['f_med'];

  $sql = "INSERT INTO findings (pr_findings_id, f_chief_complaint, f_physical_exam, f_diagnosis, f_bp, f_rr, f_cr, f_temp, f_wt, f_pr, f_med ) VALUES ('$pr_findings_id', '$f_chief_complaint',
    '$f_physical_exam', '$f_diagnosis', '$f_bp', '$f_rr', '$f_cr', '$f_temp', '$f_wt', '$f_pr', '$f_med')";

  if ($conn->query($sql) === TRUE) {
    echo "Added Findings successfully";
    header("Location: ./patientrecords.php");
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../includes/style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Admin | Patient Records</title>
</head>

<body>

  <div class="parent">
    <div class="child header">
      <p>Add Patient Findings</p>
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
                <a href="./addpatientrecord.php" class="link">
                  <ion-icon name="file-tray-full-outline"></ion-icon>
                  <span>Add Patient</span>
                </a>
              </li>
              <li class="link-item active">
                <a href="./addfindings.php" class="link">
                  <ion-icon name="medkit-outline"></ion-icon>
                  <span>Add Findings</span>
                </a>
              </li>
              <li class="link-item">
                <a href="add_user.php" class="link">
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
        <form action="" method="POST">
          <div>
            <label for="pr_findings_id">Case No.</label>
            <input type="text" name="pr_findings_id">
          </div>
          <div>
            <label for="f_chief_complaint">Chief Complaint</label>
            <input type="text" name="f_chief_complaint">
          </div>
          <div>
            <label for="f_physical_exam">Physical Examination</label>
            <input type="text" name="f_physical_exam">
          </div>
          <div>
            <label for="f_diagnosis">Diagnosis</label>
            <input type="text" name="f_diagnosis">
          </div>
          <div>
            <label for="f_med">Medication/Treatment</label>
            <input type="text" name="f_med">
          </div>
          <div>
            <label for="f_bp">Blood Pressure</label>
            <input type="text" name="f_bp">
          </div>
          <div>
            <label for="f_rr">Respiratory Rate</label>
            <input type="text" name="f_rr">
          </div>
          <div>
            <label for="f_cr">Capillary Refill</label>
            <input type="text" name="f_cr">
          </div>
          <div>
            <label for="f_temp">Temperature</label>
            <input type="text" name="f_temp">
          </div>
          <div>
            <label for="f_wt">Weight</label>
            <input type="text" name="f_wt">
          </div>
          <div>
            <label for="f_pr">Pulse Rate</label>
            <input type="text" name="f_pr">
          </div>
          <input type="submit" name="submit" value="Add">
        </form>
      </div>
    </div>

  </div>

  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>