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
    <title>Admin | View Findings</title>
    <link rel="stylesheet" href="../includes/style.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body>
    <div class="parent">
        <div class="child header">
            <h3>Patient Findings</h3>
        </div>
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
                <div>
                    <header>
                        <div>
                            <!-- <a class="back" href="viewpatient.php?id=<?= $_SESSION['id'] ?>">Back</a> -->
                        </div>
                    </header>
                    <div class="findings">
                        <?php
                        if (isset($_GET['f_id'])) {
                            $f_id = $_GET['f_id'];
                            $sql = "SELECT * FROM findings WHERE f_id = $f_id";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($result);
                        ?>
                            <h3>Chief Complaint</h3>
                            <p><?php echo $row['f_chief_complaint']; ?></p>
                            <h3>Physical Examination</h3>
                            <p><?php echo $row['f_physical_exam']; ?></p>
                            <h3>Diagnosis</h3>
                            <p><?php echo $row['f_diagnosis']; ?></p>
                        <?php
                        }
                        ?>
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