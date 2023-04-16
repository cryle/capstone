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
        <a href="./logout.php">LOGOUT</a>
      </span>
    </div>
    <div class="main">
      <a class="createuser" href="./addpatientrecord.php">Add Patient</a>
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
                <a href="./reports.php" class="link">
                  <ion-icon name="person-add-outline"></ion-icon>
                  <span>Reports</span>
                </a>
              </li>
              <li class="link-item">
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
                  <th><a href="?sort=id_no">ID No.</a></th>
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
                  if ($sort == 'id_no') {
                    $sql = "SELECT * FROM patient_record WHERE id_no LIKE '%$query%' ORDER BY id_no ASC";
                  } else if ($sort == 'pr_lname') {
                    $sql = "SELECT * FROM patient_record WHERE pr_lname LIKE '%$query%' ORDER BY pr_lname ASC";
                  } else if ($sort == 'pr_fname') {
                    $sql = "SELECT * FROM patient_record WHERE pr_fname LIKE '%$query%' ORDER BY pr_fname ASC";
                  } else if ($sort == 'pr_mname') {
                    $sql = "SELECT * FROM patient_record WHERE pr_mname LIKE '%$query%' ORDER BY pr_mname ASC";
                  } else if ($sort == 'pr_age') {
                    $sql = "SELECT * FROM patient_record WHERE pr_age LIKE '%$query%' ORDER BY pr_age ASC";
                  } else if ($sort == 'pr_date') {
                    $sql = "SELECT * FROM patient_record WHERE pr_date LIKE '%$query%' ORDER BY pr_date ASC";
                  }
                } else {
                  $sql = "SELECT * FROM patient_record WHERE id_no LIKE '%$query%' OR pr_fname LIKE '%$query%' OR pr_grade LIKE '%$query%' OR pr_section LIKE '%$query%' OR pr_strand LIKE '%$query%' OR pr_lname LIKE '%$query%' OR pr_mname LIKE '%$query%' OR pr_gender LIKE '%$query%' OR pr_age LIKE '%$query%' ";
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $id_no = $row['id_no'];
                    $pr_id = $row['pr_id'];
                    $pr_fname = $row['pr_fname'];
                    $pr_lname = $row['pr_lname'];
                    $pr_mname = $row['pr_mname'];
                    $pr_contact_no = $row['pr_contact_no'];
                    $pr_guardians_no = $row['pr_guardians_no'];
                    $pr_grade = $row['pr_grade'];
                    $pr_section = $row['pr_section'];
                    $pr_strand = $row['pr_strand'];
                    $pr_gender = $row['pr_gender'];
                    $pr_province = $row['pr_province'];
                    $pr_city = $row['pr_city'];
                    $pr_barangay = $row['pr_barangay'];
                    $pr_addrs = $row['pr_addrs'];
                    $pr_date = $row['pr_date'];
                    $pr_bdate = $row['pr_bdate'];
                    $birthdate = $row['pr_bdate'];
                    $birthdate_timestamp = strtotime($birthdate);
                    $current_timestamp = time();
                    $difference_seconds = $current_timestamp - $birthdate_timestamp;
                    $age = floor(date('Y', $difference_seconds) - 1970);


                    echo '<tr>
                        <td><a style="color: #fff; font-weight: bold; text-decoration: none;" href="addfindings.php?id=' . $id_no . '">' . $id_no . '</a></td>
                        <td>' . $pr_lname . '</td>
                        <td>' . $pr_fname . '</td>
                        <td>' . $pr_grade, '-', $pr_section . '</td>
                        <td>' . $pr_gender . '</td>
                        <td>' . $age . '</td>
                        <td class="date">' . $pr_date . '</td>
                        <td>
                    <div class="dropdown">
                      <div class="select">
                        <span class="selected">Actions</span>
                        <div class="caret"></div>
                      </div>
                      <ul class="menu">
                        <a href="viewpatient.php?id=' . $id_no . '"><li>View</li></a>
                        <a href="edit.php?id=' . $id_no . '"><li>Edit</li></a>
                        <a href="delete.php?id=' . $id_no . '"><li>Delete</li></a>
                      </ul>
                    </div>
                  </td>
                </tr>';
                  }
                } else {
                  echo "No data found";
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