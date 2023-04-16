<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'nurse') {
  header('Location: ../index.php');
  exit();
}
include "../auth/conn.php";

if (isset($_GET['id'])) {
  $id = $_GET['id'];
}

if (isset($_POST['submit'])) {
  $p_id_no = $_POST['p_id_no'];
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

  $sql = "INSERT INTO findings (p_id_no, f_chief_complaint, f_physical_exam, f_diagnosis, f_bp, f_rr, f_cr, f_temp, f_wt, f_pr, f_med ) VALUES ('$p_id_no', '$f_chief_complaint',
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
  <title>Nurse | Patient Records</title>
</head>

<body>

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
          <div class="title">Add Patient Findings</div>
          <form action="" method="POST">
            <div class="patient-details">
              <div class="input-box">
                <span class="form-details">School ID No.</span>
                <input value="<?php echo $id ?>" type="text" name="p_id_no">
              </div>
              <div class="input-box addfindings">
                <input type="submit" value="Add Patient Findings" name="submit">
              </div>
            </div>
            <div class="patient-details">
              <div class="input-box">
                <span class="form-details">Chief Complaint</span>
                <textarea rows="3" cols="44" name="f_chief_complaint" style="resize: none; padding: 5px; outline: none;" placeholder="Enter Chief Complaint"></textarea>
              </div>
              <div class="input-box">
                <span class="form-details">Physical Examination</span>
                <textarea rows="3" cols="44" name="f_physical_exam" style="resize: none; padding: 5px; outline: none;" placeholder="Enter Physical Examination"></textarea>
              </div>
              <div class="input-box">
                <span class="form-details">Diagnosis</span>
                <textarea rows="3" cols="44" name="f_diagnosis" style="resize: none; padding: 5px; outline: none;" placeholder="Enter Diagnosis"></textarea>
              </div>
              <div class="input-box">
                <span class="form-details">Medication/Treatment</span>
                <textarea rows="3" cols="44" name="f_med" style="resize: none; padding: 5px; outline: none;" placeholder="Enter Medication/Treatment"></textarea>
              </div>
            </div>
            <div class="gender-details">
              <span class="gender-title">VITAL SIGNS</span>
              <div class="patient-details">
                <div class="input-box">
                  <span class="form-details">Blood Pressure</span>
                  <input type="text" name="f_bp" placeholder="BP" required>
                </div>
                <div class="input-box">
                  <span class="form-details">Respiratory Rate</span>
                  <input type="text" name="f_rr" placeholder="BP" required>
                </div>
                <div class="input-box">
                  <span class="form-details">Capillary Refill</span>
                  <input type="text" name="f_cr" placeholder="BP" required>
                </div>
                <div class="input-box">
                  <span class="form-details">Temperature</span>
                  <input type="text" name="f_temp" placeholder="BP" required>
                </div>
                <div class="input-box">
                  <span class="form-details">Weight</span>
                  <input type="text" name="f_wt" placeholder="BP" required>
                </div>
                <div class="input-box">
                  <span class="form-details">Pulse Rate</span>
                  <input type="text" name="f_pr" placeholder="BP" required>
                </div>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>

  </div>

  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>