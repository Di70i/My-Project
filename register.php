<?php
$title="Register";
require_once 'template/header.php';
require 'config/app.php';
require_once 'config/database.php';

if (isset($_SESSION['logged_in'])) {

    header("location: index.php");
}
$errors=[];
$name='';
$email='';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email=mysqli_real_escape_string($mysqli, $_POST['email']);
    $name=mysqli_real_escape_string($mysqli, $_POST['name']);
    $password=mysqli_real_escape_string($mysqli, $_POST['password']);
    $password_confirmation=mysqli_real_escape_string($mysqli, $_POST['password_confirmation']);

    if (empty($email)) {
        array_push($errors, "Email is required");
    }
    if (empty($name)) {
        array_push($errors, "Name is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (empty($password_confirmation)) {
        array_push($errors, "Password_confirmation is required");
    }

    if ($password != $password_confirmation) {
        array_push($errors, "Passwords don't match");
    }

    if (!count($errors)) {
        $userExists=$mysqli->query("select id , email from users where email='$email' limit 1");

        if ($userExists->num_rows) {
            array_push($errors, "Email already exists");
        }
    }

    if (!count($errors)) {
        $password=password_hash($password, PASSWORD_DEFAULT);

        $query="insert into users (email , name , password) values ('$email' , '$name' , '$password')";
        $mysqli->query($query);

        $_SESSION['logged_in']=true;
        $_SESSION['user_id']=$mysqli->insert_id;
        $_SESSION['user_name']=$name;
        $_SESSION['success_message']="Welcome , $name";

        header("location: index.php");
    }

}

?>
    <div class="pt-3 container text-center">

    <div id="register">
        <h1  style="color: black;" class="title text-center">Create new Account</h1>

        <?php include 'template/errors.php' ?>
        <form action="" method="post">
            <div class="from-group">
                <label for="email">Email:</label>
                <input type="email" name="email" class="form-control  w-50 center-block" placeholder="Your email" id="email"  value="<?php echo $email?>">
            </div>
<br>
            <div class="from-group">
                <label for="name">Name:</label>
                <input type="text" name="name" class="form-control  w-50 center-block" placeholder="Your name" id="name"  value="<?php echo $name?>">
            </div>
            <br>

            <div class="from-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control  w-50 center-block" placeholder="Your password" id="password">
            </div>
            <br>

            <div class="from-group">
                <label for="password_confirmation">Confirm password:</label>
                <input type="password" name="password_confirmation" class="form-control  w-50 center-block"
                       placeholder="Confirm your password" id="password_confirmation">
            </div>
            <br>

            <div class="from-group">
                <br>
                <a href="login.php"><small>Login here...</small></a>
                <br>
                <br>
                <button class="btn btn-primary">Register!</button>
            </div>
            <br>
        </form>
    </div>
    </div>


<?php
