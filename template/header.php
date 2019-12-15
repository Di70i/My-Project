<?php
session_start();

require_once __DIR__ . '/../config/app.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="style.css">
        <link href="https://fonts.googleapis.com/css?family=UnifrakturCook:700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
              crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/5e3092f30b.js" crossorigin="anonymous"></script>
         <title><?php echo $config['app_name']?></title>

        <style>
            /* background for the all page */
            body {


            }

            /* background for the all page */
            .container {
                width: 1170px;
                margin: auto;

            }

            .header .Navbar {
                color: white;
                overflow: hidden;
                text-transform: uppercase;

            }

            .header .Navbar h2 a {
                text-decoration: none;
                text-align: center;
                margin-left: 490px;
                font-family: 'UnifrakturCook', cursive;
                color: black;
                font-size: 50px;
                float: left;

            }

            .header .Navbar ul {
                list-style: none;
                padding-left: 0;
                overflow: hidden;
                float: right;
            }

            .header .Navbar li {
                float: left;
                padding: 10px;
            }

            .header .Navbar li a  {
                text-decoration: none;
                color: black;
                font-family: Styles;
            }

            .header .Navbar li span {
                font-family: Styles;
                color: black;

            }

            .header .Navbar ul li  {
                float: left;
                padding: 10px;
            }

            .custom-card-image {
                height: 200px;
                background-size: cover;
                background-position: center;
            }
            .fas {
                margin:10px ;
                font-size: 27px;
            color: black;
            }

        </style>
    </head>
<body>
    <div class="header container-fluid">
        <div class="Navbar ">
            <div class="container">
                <h2>
                <a href="<?php echo $config['app_url'] ?>index.php">Store</a>
                </h2>
                <ul>
                    <a href="<?php echo $config['app_url'] ?>shopping_card.php">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
<?php if (!isset($_SESSION['logged_in'])): ?>

                    <li>
                        <a href="<?php echo $config['app_url'] ?>login.php">Login</a>
                    </li>
                    <li>
                        <a href="<?php echo $config['app_url'] ?>register.php">REGISTER</a>
                    </li>
<?php else: ?>
                    <li>
                        <span href="#">Hello,<?php echo $_SESSION['user_name'] ?></span>
                    </li>
                    <li>
                        <a href="<?php echo $config['app_url'] ?>logout.php">logout</a>
                    </li>
<?php endif ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="container pt-5">
<?php include 'template/message.php';