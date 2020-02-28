<?php
session_start();

require_once __DIR__ .'/../config/app.php';

error_reporting(E_ALL);
ini_set('display_errors' , 1);

?>
<!DOCTYPE html>
<html dir="<?php echo $config['dir']?>" lang="<?php echo $config['lang']?>">
<head>
    <title><?php echo $config['app_name'] . " | " . $title?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <style>
    .custom-card-image {
    height: 200px;
    background-position: center;
    background-repeat: no-repeat;
    }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
    <a class="navbar-brand" href="/"> <?php echo $config['app_name']?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="<?php $config['app_url']?>index.php">Home<span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="<?php $config['app_url']?>contact.php">Contact</a>
            </li>
        </ul>


            <ul class="navbar-nav ml-auto">
           <?php if (!isset($_SESSION['logged_in'])): ?>
                <li class="nav-item">
                <a class="nav-link" href="<?php $config['app_url']?>login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php $config['app_url']?>register.php">Register</a>
                </li>
           <?php else: ?>
                <li class="nav-item">
                    <a href="#" class="nav-link"><?php echo $_SESSION['user_name']?></a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php $config['app_url']?>logout.php">logout</a>
                    </li>
           <?php endif; ?>
            </ul>

    </div>
</nav>
<div class="container pt-5">
    <?php include 'template/message.php';