<?php
session_start();

require_once __DIR__ . '/../config/app.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
    <!DOCTYPE html>
<html dir="<?php echo $config['dir'] ?>" lang="<?php echo $config['lang'] ?>">
    <head>
        <title><?php echo $config['app_name'] . " | " . $title ?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
              integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
              crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet"
              href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css">
        <link rel="stylesheet" href="style.css">

        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <style>
            .custom-card-image {
                height: 200px;
                background-size: cover;
                background-position: center;
            }

            .navbar {
                background-color: darkslategrey !important;
            }

            .navbar-brand {
                color: wheat !important;
            }

            .nav-link {
                color: wheat !important;
            }


        </style>
    </head>
<body>
    <div class="container ">
        <nav class="navbar navbar-expand-lg navbar navbar-light bg-light shadow">
            <i class="fas fa-store-alt" style='font-size:48px;color:wheat'></i><a class="navbar-brand"
                                                                                  href="<?php echo $config['app_url'] ?>index.php"><span><?php echo $config['app_name'] ?></<span></a></i>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo $config['app_url'] ?>store.php">تسوق<span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $config['app_url'] ?>contact.php">تواصل معنا</a>
                    </li>
                </ul>


                <ul class="navbar-nav ml-auto">
                    <?php if (!isset($_SESSION['logged_in'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $config['app_url'] ?>login.php">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $config['app_url'] ?>register.php">Register</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <span href="#" class="nav-link">Hello,<?php echo $_SESSION['user_name'] ?></span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $config['app_url'] ?>logout.php">logout</a>
                        </li>
                    <?php endif ?>
                </ul>

            </div>
        </nav>
    </div>
    <div class="container pt-5">
<?php include 'template/message.php';