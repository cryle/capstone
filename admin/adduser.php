<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}
include "../auth/conn.php";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $sql = "INSERT INTO users (username, password, role) VALUES ('$username', '$password', '$role')";

    if (mysqli_query($conn, $sql)) {
        $success_msg = "User created successfully!";
        header("Location: ./add_user.php");
    } else {
        $error_msg = "Error: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Add User</title>
</head>

<body>
    <h1>Create Account</h1>
    <a href="./add_user.php">Back</a>
    <form action="" method="POST">
        <div>
            <label>Username</label>
            <input type="text" name="username">
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password">
        </div>
        <div>
            <select name="role">
                <option>Select Role</option>
                <option value="admin">Admin</option>
                <option value="doctor">Doctor</option>
                <option value="nurse">Nurse</option>
            </select>
        </div>
        <input type="submit" name="submit" value="Create">
    </form>
</body>

</html>