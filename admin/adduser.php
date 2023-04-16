<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include "../auth/conn.php";

if (isset($_POST['submit'])) {
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (user_fname, user_lname, username, password, role) VALUES ('$user_fname', '$user_lname','$username', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        $success_msg = "User created successfully!";
        header("Location: ./userrecords.php");
    } else {
        $error_msg = "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../includes/style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Admin | Create User</title>
</head>

<body class="dark-mode">
  <div class="parent">
    <div class="child header">
      <p>Create User</p>
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
        <div class="addpatientform">
          <form action="" method="POST">
        <div>
            <label>Firstname</label>
            <input type="text" name="user_fname">
        </div>
        <div>
            <label>Lastname</label>
            <input type="text" name="user_lname">
        </div>
        <div>
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div>
            <select name="role">
                <option>Select Role</option>
                <option value="admin">Admin</option>
                <option value="nurse">Nurse</option>
            </select>
        </div>
        <input type="submit" name="submit" value="Create">
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