<?php
require_once("conn.php");
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if (empty($username)) {
        $error = "username is required";
        header("Location: ../index.php?error=$error");
        exit();
    } else if (empty($password)) {
        $error = "password is required";
        header("Location: ../index.php?error=$error");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            if ($row['username'] === $username && $row['password'] === $password) {
                if ($row['role'] == "admin") {
                    header('Location: ../admin/home.php');
                } else if ($row['role'] == "nurse") {
                    header('Location: ../nurse/home.php');
                } else {
                    header('Location: ../index.php');
                }
            }
        } else {
            $error = "Incorrect username or password";
            header("Location: ../index.php?error=$error");
            exit();
        }
    }
} else {
    header('Location: ../index.php');
}
