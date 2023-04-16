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
    <title>Admin | Home</title>
    <link rel="stylesheet" href="../includes/style.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
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
                        <!-- ADD LOGO -->
                    </div>
                    <nav>
                        <ul class="link-items">
                            <li class="link-item active">
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
                <div class="home">
                    <div class="home-div">
                        <div class="home-header">
                            <h1>Welcome to Mary Josette Academy's Patient Medical Record System</h1>
                        </div>
                    </div>
                    <img src="./img/home.jpg">
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>