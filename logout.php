<?php

session_start();

if (isset($_SESSION['logged_in'])){
    $_SESSION = [];
    $_SESSION['success_message'] = '<h5 class="center-block text-center">You are logged out<h3>';
    header('location: index.php');
    die();
}