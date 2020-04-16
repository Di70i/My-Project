<?php
session_start();

require_once __DIR__ . '/../config/app.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
    <!DOCTYPE html>
    <html lang="en">
    <meta charset="utf-8">
    <head>
        <title><?php echo $config['app_name'] ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <link href="https://fonts.googleapis.com/css2?family=Anonymous+Pro:wght@700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Vibes&display=swap" rel="stylesheet">

        <style>
            body{
                font-family: 'Anonymous Pro', monospace;
                background:#eee;
            }
            .navbar-nav{
                background-color: ; ! important;

            }

            .nav-title {
                float: none;
                font-family: 'Vibes', cursive;
                color: black; ! important;
                text-decoration: none;
                font-size: 30px;
            }


            .nav-link {
                color: #777777; ! important;
                font-size: 17px;
            }


            .custom-card-image {
                height: 200px;
                width: auto;
                background-size: cover;
                background-position: center;
            }

            .custom-card-image1 {
                margin-top:50px;
                height: 300px;
                width: auto;
                background-size: 100%;
                background-position: center;
                background-repeat: no-repeat;

            }
            .custom-card-image2 {
                margin-top:50px;
                height: 300px;
                width: auto;
                background-size: 100%;
                background-position: center;
                background-repeat: no-repeat;

            }
            .card-image_shopping {
                height: 100px;
                width: auto;
                background-size: cover;
                background-position: center;
            }
            .fas{

            }
            #cart_count{
                background-color: orange;
                color: black;
                font-size: 12px;
                margin-bottom: 20px;
                padding: -5px 40px -5px -5px;
                text-align: center;
                vertical-align: top;
            }


        </style>
    </head>
<body>

    <a class="text-center nav-title"
       href="<?php echo $config['app_url']?>"><p class="p-2 nav-title"><?php echo $config['app_name']?></p>
    </a>

    <nav class="container navbar navbar-expand-lg p-4">

<!--        <a class="navbar-brand m-auto" -->
<!--           href="--><?php //echo $config['app_url']?><!--"><span class="">--><?php //echo $config['app_name']?><!--</span>-->
<!--        </a>-->

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
<?php if (!isset($_SESSION['logged_in'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $config['app_url'] ?>login.php"><i style="color: #676767" class="fas fa-user"></i></a>
                    </li>

<?php else: ?>
                    <li class="nav-item ">
                        <a class="nav-link" href="<?php echo $config['app_url'] ?>logout.php">Logout</a>
                    </li>
<?php endif ?>

                <li class="nav-item ">
                    <a href="<?php echo $config['app_url'] ?>shopping_card.php" class="nav-link">
                        <i class="fas fa-shopping-cart fa-sm" style="color: #676767">Cart</i>
                        <?php

                        if (isset($_SESSION['cart'])){
                            $count = count($_SESSION['cart']);
                            echo "<span id=\"cart_count\" class='badge text-center'>$count</span>";
                        }else{
                            echo "<span id=\"cart_count\" class='badge text-center'>0</span>";
                        }

                        ?>
                    </a>
                </li>
            </div>
        </div>
    </nav>

    <div class="container" style="">
<?php include 'template/message.php';