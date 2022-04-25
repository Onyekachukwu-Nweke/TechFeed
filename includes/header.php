<?php
require 'config/db.php';
require 'includes/form_handlers/login_handler.php';

if(isset($_SESSION['username'])){
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users WHERE username ='{$userLoggedIn}'");
    $user = mysqli_fetch_assoc($user_details_query);
}
else {
    header("Location: register.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tech Feed</title>

    <!-- JavaScript -->
    <script src="https://kit.fontawesome.com/66577b88bf.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" href="assets\css\fontawesome-free-6.1.1-web\css\all.css">
    <link rel="stylesheet" href="assets\css\fontawesome-free-6.1.1-web\webfonts\fa-solid-900.woff2">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body>

    <div class="top_bar">
        <div class="logo">
            <a href="index.php">TechFeed!</a>
        </div>

        <nav>
            <a href="#"><?php echo $user['first_name'] ?></a>
            <a href="#"><i class="fa-solid fa-house-user"></i></a>
            <a href="#"><i class="fa-solid fa-envelope"></i></a>
            <a href="#"><i class="fa-solid fa-bell"></i></a>
            <a href="#"><i class="fa-solid fa-users"></i></a>
            <a href="#"><i class="fa-solid fa-gear"></i></a>
        </nav>


    </div>

    <div class="wrapper">