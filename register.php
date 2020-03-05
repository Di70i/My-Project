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

    <div id="register">
        <h1>Register</h1>

        <?php include 'template/errors.php' ?>
        <form action="" method="post">
            <div class="from-group">
                <label for="email">Your email:</label>
                <input type="email" name="email" class="form-control" placeholder="Your email" id="email"  value="<?php echo $email?>">
            </div>

            <div class="from-group">
                <label for="name">Your name:</label>
                <input type="text" name="name" class="form-control" placeholder="Your name" id="name"  value="<?php echo $name?>">
            </div>

            <div class="from-group">
                <label for="password">Your password:</label>
                <input type="password" name="password" class="form-control" placeholder="Your password" id="password">
            </div>

            <div class="from-group">
                <label for="password_confirmation">Confirm password:</label>
                <input type="password" name="password_confirmation" class="form-control"
                       placeholder="Confirm your password" id="password_confirmation">
            </div>

            <div class="from-group">
                <br>
                <button class="btn btn-primary">Register!</button>
                <a href="login.php">login here</a>

            </div>
        </form>
    </div>


<?php
include 'template/footer.php';
