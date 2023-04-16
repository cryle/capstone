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
    <title>Admin | Reports</title>
    <link rel="stylesheet" href="../includes/style.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body class="report">
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
                            <li class="link-item active">
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
                <div class="report-container">
                <div class="report-form">
                    <form class="search-id" action="" method="GET">
                        <input type="text" value="<?php echo isset($_GET['id_no']) ? $_GET['id_no'] : "";
                    ?>" placeholder="Search" name="id_no">
                        <button type="submit">Submit</button>
                        <label for="">From Date</label>
                        <input type="date" name="from_date" value="<?php echo isset($_GET['from_date']) ? $_GET['from_date'] : "";
                    ?>">
                        <label for="">To Date</label>
                        <input type="date" name="to_date" value="<?php echo isset($_GET['to_date']) ? $_GET['to_date'] : "";
                    ?>">
                        <input type="submit" name="filter_date" value="Filter">
                    </form>
                </div>
                <div>
                    <?php
                    if(isset($_GET['id_no'])) {
                        if(!empty($_GET['id_no'])) {
                        $id_no = $_GET['id_no'];

                    $sql = "SELECT * FROM patient_record WHERE id_no = $id_no";
                    $result = $conn->query($sql);
                    $row = mysqli_fetch_array($result);

                    if($row) {
                    ?>

                    <div class="report-patient-details">
                        <h3>Patient Details</h3>
                            <div class="patient-details">
                                <div class="details-container">
                                    <div>
                                        <p class="title">PATIENT NAME: </p>
                                        <p class="title-value"><?php echo $row['pr_lname'], ', ', $row['pr_fname'], ' ', $row['pr_mname'] ?></p>
                                    </div>
                                    <div>
                                    <p class="title">GENDER:</p>
                                    <p class="title-value"><?php echo $row['pr_gender'] ?></p>
                                </div>
                                <div>
                                    <p class="title">AGE:</p>
                                    <p class="title-value"><?php echo $row['pr_age'] ?></p>
                                </div>
                                <div>
                                        <p class="title">BIRTHDATE:</p>
                                        <p class="title-value"><?php echo $row['pr_bdate'] ?></p>
                                    </div>
                                <div>
                                    <p class="title">GRADE & SECTION:</p>
                                    <p class="title-value"><?php echo $row['pr_grade'], ' - ', $row['pr_section'], ' ', ($row['pr_strand'] !== '') ?   '(' . $row['pr_strand'] . ')' : ''  ?></p>
                                </div>
                                <div>
                                    <p class="title">SCHOOL ID NO.</p>
                                    <p class="title-value"><?php echo $row['id_no']  ?></p>
                                </div>

                            </div>
                            <div class="details-container">
                                <div>
                                    <p class="title">CONTACT NO.</p>
                                    <p class="title-value"><?php echo $row['pr_contact_no'] ?></p>
                                </div>
                                <div>
                                    <p class="title">GUARDIAN'S CONTACT NO.</p>
                                    <p class="title-value"><?php echo $row['pr_guardians_no'] ?></p>
                                </div>
                                <div>
                                        <p class="title">ADDRESS:</p>
                                        <p class="title-value"><?php echo $row['pr_province'], ', ', $row['pr_city'], ', ', $row['pr_barangay'], ', ', $row['pr_addrs']  ?></p>
                                    </div>

                            </div>
                            </div>
                    </div>

                    <?php
                } else {
                    echo "No patient found in that ID";
                }
            }
                    }
                    ?>
                    
                    <?php

                    if(isset($_GET['from_date']) && isset($_GET['to_date'])) {
                        $from_date = $_GET['from_date'];
                        $to_date = $_GET['to_date'];
                        $id_no = $_GET['id_no'];

                        $sql = "SELECT * FROM findings WHERE p_id_no = '$id_no' AND f_date BETWEEN '$from_date' AND '$to_date' ";
                        $result = $conn->query($sql);

                        if($result->num_rows > 0) {
                            echo '<h3 class="findings-header">Findings</h3>';
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<div class="findings-container">';
                                echo '<div class="findings-div">'.$row['f_date'].'</div>';
                                echo '</div';                            
                            }
                        } else {
                            $sql = "SELECT * FROM findings WHERE p_id_no = '$id_no' ";
                        $result = $conn->query($sql);

                        if($result->num_rows > 0) {
                                echo '<h3>Findings</h3>';
                            while($row = mysqli_fetch_assoc($result)) {
                                echo '<div>';
                                echo '<div>'.$row['f_date'].'</div>';
                                echo '</div';
                            }
                        } else {
                            echo 'idk';
                        }
                        }
                    } else {
                            echo 'idk';
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>