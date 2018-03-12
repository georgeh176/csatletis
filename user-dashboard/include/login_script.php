<?php
session_start();

include_once 'database.php';

$sql = "SELECT * FROM login_users WHERE email = '$_POST[email]' and password = '$_POST[password]'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $sql = "SELECT member_id FROM members WHERE email = '$_POST[email]'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['member_id'];
    header('location: ../timetable.php');
} else {
    header('location: ../login.php?status=0');
}

mysqli_close($conn);


 ?>
