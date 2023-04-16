<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include "../auth/conn.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM patient_record WHERE id_no = $id";
    if (mysqli_query($conn, $sql)) {
        echo "Deleted Record";
        header("Location: ./patientrecords.php");
    }
}

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    $sql = "DELETE FROM users WHERE user_id = $user_id";
    if (mysqli_query($conn, $sql)) {
        echo "user deleted";
        header("Location: ./userrecords.php");
    }
}