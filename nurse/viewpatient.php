<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'nurse') {
    header('Location: ../index.php');
    exit();
}

include "../auth/conn.php";
?>

<!DOCTYPE html>
<html>

<head>
    <title>Nurse | View Patient Details</title>
    <link rel="stylesheet" href="../includes/style.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <div class="parent">
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
                                <a href="./addpatientrecord.php" class="link">
                                    <ion-icon name="file-tray-full-outline"></ion-icon>
                                    <span>Add Patient</span>
                                </a>
                            </li>
                            <li class="link-item">
                                <a href="./addfindings.php" class="link">
                                    <ion-icon name="medkit-outline"></ion-icon>
                                    <span>Add Findings</span>
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
                <div class="records-div">
                    <header class="header-div">
                        <h1 class="patient-header">Patient Records</h1>
                        <div>
                            <!-- <a class="details-back" href="./patientrecords.php">Back</a> -->
                        </div>
                        <div class="patientdetails">
                            <?php
                            if (isset($_GET['id'])) {
                                $pr_id = $_GET['id'];
                                $_SESSION["id"] = $_GET['id'];
                                $sql = "SELECT * FROM patient_record WHERE pr_id = $pr_id";
                                $result = mysqli_query($conn, $sql);
                                $row = mysqli_fetch_array($result);
                            ?>
                                <div class="details">
                                    <p>PATIENT NAME:</p>
                                    <h3><?php echo $row['pr_lname']; ?></h3>
                                    <h3><?php echo $row['pr_fname']; ?></h3>
                                    <h3><?php echo $row['pr_mname']; ?></h3>
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
                <div class="history">
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
                                $f_id = $_GET['id'];

                                $sql = "SELECT * FROM findings WHERE pr_findings_id = $f_id";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $f_id = $row['f_id'];
                                        $pr_findings_id = $row['pr_findings_id'];
                                        $f_diagnosis = $row['f_diagnosis'];
                                        $f_date = $row['f_date'];

                                        echo '
                                        <tr>
                                <td><a href="viewfindings.php?f_id=' . $f_id . '">' . $f_diagnosis . '</a></td>
                                <td>' . $f_date . '</td>
                              </tr>
                                 ';
                                    }
                                }
                            }
                            ?>
                        </tbody>
                    </table>
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