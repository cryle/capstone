<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

include "../auth/conn.php";
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin | Users</title>
</head>

<body>

    <h1>Users</h1>
    <ul>
        <li><a href="adduser.php">Create User</a></li>
        <li><a href="./patientrecords.php">Back</a></li>
        <li><a href="./logout.php">Logout</a></li>
        <ul>
            <table>
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Role</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

</body>

</html>