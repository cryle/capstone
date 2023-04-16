<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
  header('Location: ../index.php');
  exit();
}
include '../auth/conn.php';

if (isset($_POST['edit'])) {
  $user_fname = $_POST['user_fname'];
  $user_lname = $_POST['user_lname'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = $_POST['role'];
  $user_edit = $_POST['user_edit'];

  $sql = "UPDATE users SET user_fname = '$user_fname', user_lname = '$user_lname', username = '$username', password = '$password', role = '$role' WHERE user_id = $user_edit ";

  if ($conn->query($sql) === TRUE) {
    echo "Edited successfully";
    header("Location: ./userrecords.php");
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
              <li class="link-item ">
                <a href="./patientrecords" class="link"><ion-icon name="search-outline"></ion-icon>
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
        <header>
          <div>
            <!-- <a class="edit-back" href="./patientrecords.php">Back</a> -->
          </div>
        </header>
        <?php
        if (isset($_GET['user_id'])) {
          $user_id = $_GET['user_id'];

          $sql = "SELECT * FROM users WHERE user_id = $user_id";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_array($result);

        ?>
          <div class="addpatientform">
            <form action="" method="POST" style="color: white;">
              <div>
                <label for="user_fname">Firstname</label>
                <input type="text" value="<?php echo $row['user_fname'] ?>" name="user_fname">
              </div>
              <div>
                <label for="user_lname">Lastname</label>
                <input type="text" value="<?php echo $row['user_lname'] ?>" name="user_lname">
              </div>
              <div>
                <label for="username">Username</label>
                <input type="text" value="<?php echo $row['username'] ?>" name="username">
              </div>
              <div>
                <label for="pr_grade_section">Password</label>
                <input type="password" value="<?php echo $row['password'] ?>" name="password">
              </div>
              <div>
                <label for="role">Role</label>
                <select name="role">
                  <option value="">Select Gender</option>
                  <option value="admin" <?php if ($row['role'] == "admin") {
                                          echo "selected";
                                        } ?>>Admin</option>
                  <option value="nurse" <?php if ($row['role'] == "Nurse") {
                                            echo "selected";
                                          } ?>>Nurse</option>
                </select>
              </div>
              <input type="hidden" name="user_edit" value="<?php echo $row['user_id']; ?>">
              <input type="submit" name="edit" value="Save">
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