<?php
session_start();
include('connection.php');
if (isset($_SESSION['email'])) {
    header('Location: index.php');
    exit;
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query the database for the user with the entered email
    $query = "SELECT * FROM end_users WHERE email='$email'";
    $result = mysqli_query($connect, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        // Valid email, check password
        $user = mysqli_fetch_assoc($result);
        $hashed_password = $user['password'];
        if($_POST['user_input'] == ""){
            if ($_SESSION['secure'] == $_POST['user_input']) {
                echo "<script>alert('good');
                window.location.href='index.php';</script>";
            } else {
                echo "<script>alert('bad');
                window.location.href='index.php';</script>";
            }
        }
        if (password_verify($password, $hashed_password) ) {
            // Valid password, set session variables and redirect to faqchat.php
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            header('Location: faqchat.php');
            exit;
        } else {
            // Invalid password, show an error message
            echo "<script>alert('invalid email');
             window.location.href='index.php';</script>";

        }
    } else {
        // Invalid email, show an error message
        echo "<script>alert('invalid email');
        window.location.href='index.php';</script>";

    }
}
?>