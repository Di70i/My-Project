<?php
$title = "Register";
require_once 'template/header.php';
require 'config/app.php';
require_once 'config/database.php';

if (isset($_SESSION['logged_in'])) {

    header("location: index.php");
}
$errors = [];
$name = '';
$email = '';


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

    }
    $_SESSION['logged_in']=true;
    $_SESSION['user_id']=$mysqli->insert_id;
    $_SESSION['user_name'] = $name;
    $_SESSION['success_message'] = "Welcome , $name";



}

?>

<div id="register">
    <form action="" method="post">
        <h2>Welcome to our website</h2>
        <h6 class="text-info">Please fil the form below</h6>
        <hr>
        <?php include 'template/errors.php'?>
        <div class="form-group">
            <label for="name">Your name:</label>
            <input type="name" name="name" class="from-control" placeholder="Your name" id="name" value="<?php echo $name?>">
        </div>

        <div class="form-group">
            <label for="email">Your email:</label>
            <input type="email" name="email" class="from-control" placeholder="Your email" id="email" value="<?php echo $email?>">

        </div>

        <div class="form-group">
            <label for="password">Your password:</label>
            <input type="password" name="password" class="from-control" placeholder="Your password" id="password">
        </div>

        <div class="form-group">
            <label for="password_confirmation">confirm password:</label>
            <input type="password" name="password_confirmation" class="from-control" placeholder="confirm your password" id="password_confirmation">
        </div>

        <div class="form-group">
            <button class="btn btn-success">Register!</button>
        </div>
    </form>

</div>
<?php
include 'template/footer.php';
