<?php
session_start();
include './connection.php';

if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to index.php
    header('Location: index.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM end_users WHERE id = '$user_id'";
$result = mysqli_query($connect, $query);
$user = mysqli_fetch_assoc($result);


?>