<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../index.php');
  exit();
}
include '../auth/conn.php';

if (isset($_POST['edit'])) {
  $pr_fname = $_POST['pr_fname'];
  $pr_lname = $_POST['pr_lname'];
  $pr_mname = $_POST['pr_mname'];
  $pr_grade_section = $_POST['pr_grade_section'];
  $pr_gender = $_POST['pr_gender'];
  $pr_age = $_POST['pr_age'];
  $pr_addrs = $_POST['pr_addrs'];
  $pr_bdate = $_POST['pr_bdate'];
  $ed_id = $_POST['ed_id'];

  $sql = "UPDATE patient_record SET pr_fname = '$pr_fname', pr_lname = '$pr_lname', pr_mname = '$pr_mname', pr_gender = '$pr_gender', pr_grade_section = '$pr_grade_section', pr_age = '$pr_age', pr_addrs = '$pr_addrs', pr_bdate = '$pr_bdate' WHERE pr_id = $ed_id ";

  if ($conn->query($sql) === TRUE) {
    echo "Edited successfully";
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
  <title>Home | Clinic</title>
</head>

<body class="dark-mode">
  <div class="parent">
    <div class="child header">
      <p>Edit Patient Record</p>
    </div>
    <div class="main">
      <div class="child">
        <div class="container">
          <div class="logo">
          </div>
          <nav>
            <ul class="link-items ">
              <li class="link-item ">
                <a href="./home.php" class="link">
                  <ion-icon name="home-outline"></ion-icon>
                  <span>Home</span>
                </a>
              </li>
              <li class="link-item active ">
                <a href="search.php" class="link"><ion-icon name="search-outline"></ion-icon>
                  <span>Patient Records</span>
                </a>
              </li>
              <li class="link-item ">
                <a href="addpatientrecord.php" class="link">
                  <ion-icon class="noti-icon" name="notifications-outline"></ion-icon>
                  <span>Add Patient</span>
                </a>
              </li>
              <li class="link-item ">
                <a href="addfindings.php" class="link">
                  <ion-icon class="noti-icon" name="notifications-outline"></ion-icon>
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
        <header>
          <div>
            <!-- <a class="edit-back" href="./patientrecords.php">Back</a> -->
          </div>
        </header>
        <?php
        if (isset($_GET['id'])) {
          $id = $_GET['id'];

          $sql = "SELECT * FROM patient_record WHERE pr_id = $id";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);

        ?>
          <div class="addpatientform">
            <form action="" method="POST" style="color: white;">
              <div>
                <label for="pr_fname">Firstname</label>
                <input type="text" value="<?php echo $row['pr_fname'] ?>" name="pr_fname">
              </div>
              <div>
                <label for="pr_lname">Lastname</label>
                <input type="text" value="<?php echo $row['pr_lname'] ?>" name="pr_lname">
              </div>
              <div>
                <label for="pr_mname">Middle Initial</label>
                <input type="text" value="<?php echo $row['pr_mname'] ?>" name="pr_mname">
              </div>
              <div>
                <label for="pr_grade_section">Grade & Section</label>
                <input type="text" value="<?php echo $row['pr_grade_section'] ?>" name="pr_grade_section">
              </div>
              <div>
                <label for="pr_gender">Gender</label>
                <select name="pr_gender">
                  <option value="">Select Gender</option>
                  <option value="Male" <?php if ($row['pr_gender'] == "Male") {
                                          echo "selected";
                                        } ?>>Male</option>
                  <option value="Female" <?php if ($row['pr_gender'] == "Female") {
                                            echo "selected";
                                          } ?>>Female</option>
                </select>
              </div>
              <div>
                <label for="pr_age">Age</label>
                <input type="text" value="<?php echo $row['pr_age'] ?>" name="pr_age">
              </div>
              <div>
                <label for="pr_addrs">Address</label>
                <input type="text" value="<?php echo $row['pr_addrs'] ?>" name="pr_addrs">
              </div>
              <div>
                <label for="pr_bdate">Birthdate</label>
                <input type="date" value="<?php echo $row['pr_bdate'] ?>" name="pr_bdate">
              </div>
              <input type="hidden" name="ed_id" value="<?php echo $row['pr_id']; ?>">
              <input type="submit" name="edit" value="Save Edit">
            </form>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
  </div>

  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>