<?php require_once __DIR__ .'/../config/app.php';

error_reporting(E_ALL);
ini_set('display_errors' , 1);

?>
<!DOCTYPE html>
<html dir="<?php echo $config['dir']?>" lang="<?php echo $config['lang']?>">
<head>
    <title><?php echo $config['app_name'] . " | " . $title?></title>
    <meta charset="UTF-8">
    <link  rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <style>
    .custom-card-image {
    height: 200px;
    background-position: center;
    background-repeat: no-repeat;
    }
    </style>
</head>

<body>
<div class="container">
    <?php isset($_SESSION['visitor_name']) ? $sender = $_SESSION['visitor_name'] : $sender = "" ?>
    <p>Hello <?php echo $sender ?></p>
