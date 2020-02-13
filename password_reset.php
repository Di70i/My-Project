<?php
$title = "password reset";
require_once 'template/header.php';
require 'config/app.php';
require_once 'config/database.php';



if (isset($_SESSION['logged_in'])) {
    header("location: index.php");
}

$errors = [];
$email = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email=mysqli_real_escape_string($mysqli, $_POST['email']);

    if (empty($email)) {array_push($errors, "Email is required");}

    if (!count($errors)) {

        $userExists=$mysqli->query("select id , email , name from users where email='$email' limit 1");

        if ($userExists->num_rows) {

           $userId = $userExists->fetch_assoc()['id'];


           $tokenExists = $mysqli->query("delete from password_resets where user_id='$userId'");

           $token = bin2hex(random_bytes(4));

           $expires_at = date('Y-m-d H:i:s' , strtotime('+1 day'));


           $mysqli->query("insert into password_resets (user_id , token , expires_at)
                          values ('$userId' , '$token' , '$expires_at')
                           ");
        }

        $_SESSION['success_message'] = 'Please check your email for password reset link';
        header('location: password_reset.php');

}
    if (!count($errors)) {

        $query_login="select password , email  from users  where  LIMIT 1";
        $mysqli->query($query_login);
    }

}

?>
<div id="password_rest">
        <h2>Password reset</h2>
        <h6 class="text-info">fill your email to reset your password</h6>
        <hr>
        <?php include 'template/errors.php'?>

        <form action="" method="post">
        <div class="form-group">
            <label for="email">Your email:</label>
            <input type="email" name="email" class="from-control" placeholder="Your email" id="email" value="<?php echo $email?>">

        </div>

        <div class="form-group">
            <button class="btn btn-primary">Request password reset link!</button>
        </div>
    </form>

</div>
<?php
include 'template/footer.php';

