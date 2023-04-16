<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

include "../auth/conn.php";
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../includes/style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Admin | Users</title>
</head>

<body>

  <div class="parent">
    <div class="child header">
      <span class="header-content">
        <span class="header-content">
              <a href="./logout.php">LOGOUT</a>
          </span>
    </div>
    <div class="main">
          <a class="createuser" href="./adduser.php">Create User</a>
      <div class="child">
        <div class="container">
          <div class="logo">
            <!-- LOGO -->
          </div>
          <nav>
            <ul class="link-items">
              <li class="link-item">
                <a href="./home.php" class="link">
                  <ion-icon name="home-outline"></ion-icon>
                  <span style="--i: 1">Home</span>
                </a>
              </li>
              <li class="link-item">
                <a href="./patientrecords.php" class="link">
                  <ion-icon name="person-outline"></ion-icon>
                  <span style="--i: 3">Patient Records</span>
                </a>
              </li>
              <li class="link-item">
                <a href="./reports.php" class="link">
                  <ion-icon name="person-add-outline"></ion-icon>
                  <span>Reports</span>
                </a>
              </li>
              <li class="link-item active">
                <a href="./userrecords.php" class="link">
                  <ion-icon name="person-add-outline"></ion-icon>
                  <span style="--i: 4">User Management</span>
                </a>
              </li>
              <li class="link-item user">
                <a href="./logout.php" class="link">
                  <img src="../public/winter.jpg" alt="user-icon">
                  <span style="--i: 9">
                    <h4>
                      <?= $_SESSION['username'] ?>
                    </h4>
                    <p>
                      <?= $_SESSION['role'] ?>
                    </p>
                  </span>
                </a>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <div class="child content">
        <div class="search-container">
          <form class="search-form" method="get" action="">
            <i class='bx bx-search'></i>
            <input type="text" name="user" placeholder="Search User">
            <button type="submit">Search</button>
          </form>
        </div>
        <main class="table">
          <section class="table__header">
            <h1>User Records</h1>
          </section>
          <section class="table__body">
            <table>
              <thead>
                <tr>
                  <th><a href="?sort=user_id">User ID</a></th>
                  <th><a href="?sort=user_lname">Last Name</a></th>
                  <th><a href="?sort=user_fname">First Name</a></th>
                  <th><a href="?sort=username">Username</a></th>
                  <th><a href="?sort=username">Date Created</a></th>
                  <th>Role</th>
                  <th>Edit</th>
                  <th>Delete</th>
                </tr>
              </thead>
              <tbody>
                <?php

                if (isset($_GET['user'])) {
                  $user = $_GET['user'];
                } else {
                  $user = "";
                }

                if (isset($_GET['sort'])) {
                  $sort = $_GET['sort'];
                  if ($sort == 'user_id') {
                    $sql = "SELECT * FROM users WHERE user_id LIKE '%$user%' ORDER BY user_id";
                  } else if ($sort == 'user_lname') {
                    $sql = "SELECT * FROM users WHERE user_lname LIKE '%$user%' ORDER BY user_lname";
                  } else if ($sort == 'user_fname') {
                    $sql = "SELECT * FROM users WHERE user_fname LIKE '%$user%' ORDER BY user_fname";
                  } else if ($sort == 'username') {
                    $sql = "SELECT * FROM users WHERE username LIKE '%$user%' ORDER BY username";
                  } else if ($sort == 'user_created') {
                    $sql = "SELECT * FROM users WHERE user_created LIKE '%$user%' ORDER BY user_created";
                  } 
                } else {
                  $sql = "SELECT * FROM users WHERE user_id LIKE '%$user%' OR user_lname LIKE '%$user%' OR user_fname LIKE '%$user%' OR username LIKE '%$user%' OR user_created LIKE '%$user%' ";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $user_id = $row['user_id'];
                    $user_fname = $row['user_fname'];
                    $user_lname = $row['user_lname'];
                    $username = $row['username'];
                    $user_created = $row['user_created'];
                    $role = $row['role'];

                    echo '<tr>
                        <td>' . $user_id . '</td>
                        <td>' . $user_lname . '</td>
                        <td>' . $user_fname . '</td>
                        <td>' . $username . '</td>
                        <td>' . $user_created . '</td>
                        <td>
                            '.$role.'
                        </td>
                        <td>
                            <div class="user-actions">
                                <a href="editusers.php?user_id=' . $user_id . '">Edit</a>
                            <div>
                        </td>
                        <td>
                            <div class="user-actions">
                                <a href="delete.php?user_id=' . $user_id . '">Delete</a>
                            <div>
                        </td>
                </tr>';
                  }
                } else {
                  echo "0 results";
                }
                ?>
              </tbody>
            </table>
          </section>
        </main>
      </div>
    </div>

  </div>

  <script>
    let inputBox = document.querySelector(".search-patient"),
      searchIcon = document.querySelector(".icon"),
      closeIcon = document.querySelector(".close-icon");

    searchIcon.addEventListener("click", () => inputBox.classList.add("open"));
    closeIcon.addEventListener("click", () => inputBox.classList.remove("open"));
  </script>

  <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script src="../button.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>