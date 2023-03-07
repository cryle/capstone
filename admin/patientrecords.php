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
  <link rel="stylesheet" href="../includes/style.css">
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Admin | Patient Records</title>
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
              <li class="link-item active">
                <a href="./patientrecords.php" class="link">
                  <ion-icon name="person-outline"></ion-icon>
                  <span style="--i: 3">Patient Records</span>
                </a>
              </li>
              <li class="link-item">
                <a href="./addpatientrecord.php" class="link">
                  <ion-icon name="file-tray-full-outline"></ion-icon>
                  <span>Add Patient</span>
                </a>
              </li>
              <li class="link-item">
                <a href="./addfindings.php" class="link">
                  <ion-icon name="medkit-outline"></ion-icon>
                  <span style="--i: 4">Add Findings</span>
                </a>
              </li>
              <li class="link-item">
                <a href="add_user.php" class="link">
                  <ion-icon name="person-add-outline"></ion-icon>
                  <span style="--i: 4">Add User</span>
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
            <input type="text" name="query" placeholder="Search Patient">
            <button type="submit">Search</button>
          </form>
        </div>
        <main class="table">
          <section class="table__header">
            <h1>Patient Records</h1>
          </section>
          <section class="table__body">
            <table>
              <thead>
                <tr>
                  <th><a href="?sort=pr_id">Case No.</a></th>
                  <th><a href="?sort=pr_lname">Last Name</a></th>
                  <th><a href="?sort=pr_fname">First Name</a></th>
                  <th>Grade & Section</th>
                  <th>Gender</th>
                  <th><a href="?sort=pr_age">Age</a></th>
                  <th class="date"><a href="?sort=pr_date">Date Added</a></th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php

                if (isset($_GET['query'])) {
                  $query = $_GET['query'];
                } else {
                  $query = "";
                }

                if (isset($_GET['sort'])) {
                  $sort = $_GET['sort'];
                  if ($sort == 'pr_id') {
                    $sql = "SELECT * FROM patient_record WHERE pr_id LIKE '%$query%' OR pr_fname LIKE '%$query%' OR pr_lname LIKE '%$query%' OR pr_mname LIKE '%$query%' OR pr_grade_section LIKE '%$query%' OR pr_gender LIKE '%$query%' OR pr_age LIKE '%$query%' OR pr_addrs LIKE '%$query%' ORDER BY pr_id";
                  } else if ($sort == 'pr_lname') {
                    $sql = "SELECT * FROM patient_record WHERE pr_id LIKE '%$query%' OR pr_fname LIKE '%$query%' OR pr_lname LIKE '%$query%' OR pr_mname LIKE '%$query%' OR pr_grade_section LIKE '%$query%' OR pr_gender LIKE '%$query%' OR pr_age LIKE '%$query%' OR pr_addrs LIKE '%$query%' ORDER BY pr_lname";
                  } else if ($sort == 'pr_fname') {
                    $sql = "SELECT * FROM patient_record WHERE pr_id LIKE '%$query%' OR pr_fname LIKE '%$query%' OR pr_lname LIKE '%$query%' OR pr_mname LIKE '%$query%' OR pr_grade_section LIKE '%$query%' OR pr_gender LIKE '%$query%' OR pr_age LIKE '%$query%' OR pr_addrs LIKE '%$query%' ORDER BY pr_fname";
                  } else if ($sort == 'pr_mname') {
                    $sql = "SELECT * FROM patient_record WHERE pr_id LIKE '%$query%' OR pr_fname LIKE '%$query%' OR pr_lname LIKE '%$query%' OR pr_mname LIKE '%$query%' OR pr_grade_section LIKE '%$query%' OR pr_gender LIKE '%$query%' OR pr_age LIKE '%$query%' OR pr_addrs LIKE '%$query%' ORDER BY pr_mname";
                  } else if ($sort == 'pr_age') {
                    $sql = "SELECT * FROM patient_record WHERE pr_id LIKE '%$query%' OR pr_fname LIKE '%$query%' OR pr_lname LIKE '%$query%' OR pr_mname LIKE '%$query%' OR pr_grade_section LIKE '%$query%' OR pr_gender LIKE '%$query%' OR pr_age LIKE '%$query%' OR pr_addrs LIKE '%$query%' ORDER BY pr_age";
                  } else if ($sort == 'pr_date') {
                    $sql = "SELECT * FROM patient_record WHERE pr_id LIKE '%$query%' OR pr_fname LIKE '%$query%' OR pr_lname LIKE '%$query%' OR pr_mname LIKE '%$query%' OR pr_grade_section LIKE '%$query%' OR pr_gender LIKE '%$query%' OR pr_age LIKE '%$query%' OR pr_addrs LIKE '%$query%' ORDER BY pr_date";
                  }
                } else {
                  $sql = "SELECT * FROM patient_record WHERE pr_id LIKE '%$query%' OR pr_fname LIKE '%$query%' OR pr_lname LIKE '%$query%' OR pr_mname LIKE '%$query%' OR pr_grade_section LIKE '%$query%' OR pr_gender LIKE '%$query%' OR pr_age LIKE '%$query%' OR pr_addrs LIKE '%$query%' ";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $pr_id = $row['pr_id'];
                    $pr_fname = $row['pr_fname'];
                    $pr_lname = $row['pr_lname'];
                    $pr_mname = $row['pr_mname'];
                    $pr_grade_section = $row['pr_grade_section'];
                    $pr_gender = $row['pr_gender'];
                    $pr_age = $row['pr_age'];
                    $pr_addrs = $row['pr_addrs'];
                    $pr_date = $row['pr_date'];

                    echo '<tr>
                        <td>' . $pr_id . '</td>
                        <td>' . $pr_lname . '</td>
                        <td>' . $pr_fname . '</td>
                        <td>' . $pr_grade_section . '</td>
                        <td>' . $pr_gender . '</td>
                        <td>' . $pr_age . '</td>
                        <td class="date">' . $pr_date . '</td>
                        <td>
                    <div class="dropdown">
                      <div class="select">
                        <span class="selected">Actions</span>
                        <div class="caret"></div>
                      </div>
                      <ul class="menu">
                        <a href="viewpatient.php?id=' . $pr_id . '"><li>View</li></a>
                        <a href="edit.php?id=' . $pr_id . '"><li>Edit</li></a>
                        <a href="delete.php?id=' . $pr_id . '"><li>Delete</li></a>
                      </ul>
                    </div>
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