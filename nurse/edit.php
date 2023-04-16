<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'nurse') {
  header('Location: ../index.php');
  exit();
}
include '../auth/conn.php';

if (isset($_POST['edit'])) {
  $id_no = $_POST['id_no'];
  $pr_fname = $_POST['pr_fname'];
  $pr_lname = $_POST['pr_lname'];
  $pr_contact_no = $_POST['pr_contact_no'];
  $pr_guardians_no = $_POST['pr_guardians_no'];
  $pr_grade = $_POST['pr_grade'];
  $pr_section = $_POST['pr_section'];
  $pr_strand = $_POST['pr_strand'];
  $pr_gender = $_POST['pr_gender'];
  $pr_province = $_POST['pr_province'];
  $pr_city = $_POST['pr_city'];
  $pr_barangay = $_POST['pr_barangay'];
  $pr_addrs = $_POST['pr_addrs'];
  $pr_bdate = $_POST['pr_bdate'];
  $birthdate = $_POST['pr_bdate'];
  $birthdate_timestamp = strtotime($birthdate);
  $current_timestamp = time();
  $difference_seconds = $current_timestamp - $birthdate_timestamp;
  $age = floor(date('Y', $difference_seconds) - 1970);
  $ed_id = $_POST['ed_id'];

  $sql = "UPDATE patient_record SET id_no = '$id_no', pr_fname = '$pr_fname', pr_lname = '$pr_lname', pr_contact_no = '$pr_contact_no', pr_guardians_no = '$pr_guardians_no', pr_grade = '$pr_grade', pr_section = '$pr_section', pr_strand = '$pr_strand', pr_gender = '$pr_gender', pr_province = '$pr_province', pr_city = '$pr_city', pr_barangay = '$pr_barangay', pr_addrs = '$pr_addrs', pr_bdate = '$pr_bdate', pr_age = '$age' WHERE id_no = $ed_id ";

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
  <?php include 'script.js' ?>
  <title>Nurse | Edit Patient Record</title>
</head>

<body class="dark-mode">
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
            <ul class="link-items ">
              <li class="link-item ">
                <a href="./home.php" class="link">
                  <ion-icon name="home-outline"></ion-icon>
                  <span>Home</span>
                </a>
              </li>
              <li class="link-item ">
                <a href="./patientrecords.php" class="link"><ion-icon name="search-outline"></ion-icon>
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
          <div class="title">Edit Patient Record</div>
          <?php
          if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM patient_record WHERE id_no = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);

            $pr_section = $row['pr_section'];

          ?>
            <div class="addpatientform">
              <form action="" method="POST">
                <span class="patient-title">Patient Details</span>
                <div class="patient-details">
                  <div class="input-box">
                    <span class="form-details">School ID No.</span>
                    <input type="text" name="id_no" placeholder="Enter School ID No." value="<?php echo $row['id_no'] ?>" required>
                  </div>
                  <div class="input-box">
                    <span class="form-details">Firstname</span>
                    <input type="text" name="pr_fname" placeholder="Enter firstname" value="<?php echo $row['pr_fname'] ?>" required>
                  </div>
                  <div class="input-box">
                    <span class="form-details">Lastname</span>
                    <input type="text" name="pr_lname" placeholder="Enter lastname" value="<?php echo $row['pr_lname'] ?>" required>
                  </div>
                  <div class="input-box">
                    <span class="form-details">Contact No.</span>
                    <input type="text" name="pr_contact_no" placeholder="Enter contact number" value="<?php echo $row['pr_contact_no'] ?>" required>
                  </div>
                  <div class="input-box">
                    <span class="form-details">Guardian's Contact No.</span>
                    <input type="text" name="pr_guardians_no" placeholder="Enter guardian's contact number" value="<?php echo $row['pr_guardians_no'] ?>" required>
                  </div>
                  <div class="input-box">
                    <span class="form-details">Birthdate</span>
                    <input type="date" name="pr_bdate" placeholder="Enter birthday" value="<?php echo $row['pr_bdate'] ?>" required>
                  </div>
                </div>
                <div class="gender-details">
                  <span class="gender-title">Grade & Section</span>
                  <div class="category">
                    <label>
                      <select name="pr_grade" class="add-select">
                        <option>Grade</option>
                        <option value="1" <?php if ($row['pr_grade'] == "1") {
                                            echo "selected";
                                          } ?>>1</option>
                        <option value="2" <?php if ($row['pr_grade'] == "2") {
                                            echo "selected";
                                          } ?>>2</option>
                        <option value="3" <?php if ($row['pr_grade'] == "3") {
                                            echo "selected";
                                          } ?>>3</option>
                        <option value="4" <?php if ($row['pr_grade'] == "4") {
                                            echo "selected";
                                          } ?>>4</option>
                        <option value="5" <?php if ($row['pr_grade'] == "5") {
                                            echo "selected";
                                          } ?>>5</option>
                        <option value="6" <?php if ($row['pr_grade'] == "6") {
                                            echo "selected";
                                          } ?>>6</option>
                        <option value="7" <?php if ($row['pr_grade'] == "7") {
                                            echo "selected";
                                          } ?>>7</option>
                        <option value="8" <?php if ($row['pr_grade'] == "8") {
                                            echo "selected";
                                          } ?>>8</option>
                        <option value="9" <?php if ($row['pr_grade'] == "9") {
                                            echo "selected";
                                          } ?>>9</option>
                        <option value="10" <?php if ($row['pr_grade'] == "10") {
                                              echo "selected";
                                            } ?>>10</option>
                        <option value="11" <?php if ($row['pr_grade'] == "11") {
                                              echo "selected";
                                            } ?>>11</option>
                        <option value="12" <?php if ($row['pr_grade'] == "12") {
                                              echo "selected";
                                            } ?>>12</option>
                      </select>
                    </label>
                    <label>
                      <select name="pr_section" class="add-select">
                        <option>Section</option>
                        <option value="Napier" <?php if ($row['pr_section'] == "Napier") {
                                                  echo "selected";
                                                } ?>>Napier</option>
                        <option value="Wind" <?php if ($row['pr_section'] == "Wind") {
                                                echo "selected";
                                              } ?>>Wind</option>
                      </select>
                    </label>
                    <label>
                      <select name="pr_strand" class="add-select">
                        <option>Strand</option>
                        <option value="ICT" <?php if ($row['pr_strand'] == "ICT") {
                                              echo "selected";
                                            } ?>>ICT</option>
                        <option value="STEM" <?php if ($row['pr_strand'] == "STEM") {
                                                echo "selected";
                                              } ?>>STEM</option>
                      </select>
                    </label>
                  </div>
                </div>
                <div class="gender-details">
                  <input type="radio" name="pr_gender" value="Male" id="dot-1" <?php echo ($row['pr_gender'] === 'Male') ? 'checked' : ''; ?>>
                  <input type="radio" name="pr_gender" value="Female" id="dot-2" <?php echo ($row['pr_gender'] === 'Female') ? 'checked' : ''; ?>>
                  <span class="gender-title">Gender</span>
                  <div class="category">
                    <label for="dot-1">
                      <span class="dot one"></span>
                      <span class="gender">Male</span>
                    </label>
                    <label for="dot-2">
                      <span class="dot two"></span>
                      <span class="gender">Female</span>
                    </label>
                  </div>
                </div>
                <div class="gender-details">
                  <span class="gender-title">Address</span>
                  <div class="category">
                    <label>
                      <select class="add-select" name="pr_province" id="provinceSelect" onchange="populateCities()">
                        <option value="">Province</option>
                        <script>
                          for (var i = 0; i < provinceOptions.length; i++) {
                            var option = document.createElement("option");
                            option.value = provinceOptions[i];
                            option.text = provinceOptions[i];
                            if (provinceOptions[i] === "<?php echo $row['pr_province']; ?>") {
                              option.selected = true;
                            }
                            document.getElementById("provinceSelect").add(option);
                          }
                        </script>
                      </select>
                      <select class="add-select" name="pr_city" id="citySelect" onchange="populateBarangays()">
                        <option value="">City</option>
                        <script>
                          if ("<?php echo $row['pr_province']; ?>" !== "") {
                            // Get the cities for the selected Province
                            var cities = cityOptions["<?php echo $row['pr_province']; ?>"];
                            // Add the cities as options to the City select element
                            for (var i = 0; i < cities.length; i++) {
                              var option = document.createElement("option");
                              option.value = cities[i];
                              option.text = cities[i];
                              if (cities[i] === "<?php echo $row['pr_city']; ?>") {
                                option.selected = true;
                              }
                              citySelect.add(option);
                            }
                          }
                        </script>
                      </select>

                      <select class="add-select" name="pr_barangay" id="barangaySelect">
                        <option value="">Barangay</option>
                        <script>
                          if ("<?php echo $row['pr_city']; ?>" !== "") {
                            // Get the barangays for the selected City
                            var barangays = barangayOptions["<?php echo $row['pr_city']; ?>"];
                            // Add the barangays as options to the Barangay select element
                            for (var i = 0; i < barangays.length; i++) {
                              var option = document.createElement("option");
                              option.value = barangays[i];
                              option.text = barangays[i];
                              if (barangays[i] === "<?php echo $row['pr_barangay']; ?>") {
                                option.selected = true;
                              }
                              barangaySelect.add(option);
                            }
                          }
                        </script>
                      </select>
                    </label>
                  </div>
                </div>
                <div class="patient-details">
                  <div class="input-box">
                    <span class="form-details">Street Name, Building, House No.</span>
                    <input type="text" name="pr_addrs" value="<?php echo $row['pr_addrs'] ?>" placeholder="Street Name, Building, House No." required>
                  </div>

                  <div class="input-box edit-div">
                    <input type="hidden" name="ed_id" value="<?php echo $id ?>">
                    <input type="submit" value="Save" name="edit">
                  </div>
                </div>
              </form>
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