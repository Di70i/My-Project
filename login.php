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

    <div id="login">

        <form action="" method="post">
            <h2>Welcome back</h2>
            <h5  style="color: dimgray" class="text">Please fill the form to login</h5>
            <hr>
            <?php include 'template/errors.php' ?>

            <div class="from-group">
                <label for="email">Your email:</label>
                <input type="email" name="email" class="form-control" placeholder="Your email" id="email" value="<?php echo $email?>">
            </div>

            <div class="from-group">
                <label for="password">Your password:</label>
                <input type="password" name="password" class="form-control" placeholder="Your password" id="password">
            </div>


            <div class="from-group">
                <br>
                <button class="btn btn-primary">Login!</button>
                <a href="change_password.php">Forgot your password?</a>

            </div>
        </form>
    </div>


<?php
include 'template/footer.php';

