<?php
$title = "login";
require_once 'template/header.php';
require 'config/app.php';
require_once 'config/database.php';


if (isset($_SESSION['logged_in'])) {
    header("location: index.php");
}

$errors = [];
$email = '';
$fundUser['name'] = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email=mysqli_real_escape_string($mysqli, $_POST['email']);
    $password=mysqli_real_escape_string($mysqli, $_POST['password']);

    if (empty($email)) {array_push($errors, "Email is required");}
    if (empty($password)){array_push($errors, "Password is required");}


    if (!count($errors)) {
        $userExists=$mysqli->query("select id , email , password , name  , role  from users where email='$email' limit 1");

        if (!$userExists->num_rows) {

            array_push($errors, "Your email, $email does not exists in our records.");

        } else {
            $fundUser = $userExists->fetch_assoc();

            if (password_verify($password , $fundUser['password'])){

                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $fundUser['id'];
                $_SESSION['user_name'] = $fundUser['name'];
                $_SESSION['user_role'] = $fundUser['role'];


                if ($fundUser['role'] == 'admin'){
                    header('location: admin/index.php');
                }else{

                    $_SESSION['success_message'] = "Welcome back, $fundUser[name]";
                    header('location: index.php');

                }

            }else{

                array_push($errors, "Wrong password");

            }

        }

    }
    if (!count($errors)) {

        $query_login="select password , email  from users  where  LIMIT 1";
        $mysqli->query($query_login);
    }

}


?>


    <div class="pt-3 container text-center" id="login">

        <form action="" method="post">
            <h1  style="color: black" class="title text-center">تسجيل الدخول</h1>
            <br>
            <?php include 'template/errors.php' ?>

            <div class="from-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control w-50 center-block" placeholder="Your email" id="email" value="<?php echo $email?>">
            </div>
<br>
            <div class="from-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control  center-block  w-50" placeholder="Your password" id="password">
            </div>

            <div class="from-group text-center">
                <br><br>
                <button class="btn btn-primary">Login!</button>
                <br>
                <br>
                <a href="register.php">  Creat account </a><strong>|</strong><a href="Password_reset.php"> Forgot your password? </a>

            </div>
            <br>
        </form>
    </div>


<?php
