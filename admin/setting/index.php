<?php
$title='Setting';
$icon='pe-7s-config';
include __DIR__ . '/../template/header.php';


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $st = $mysqli->prepare('update setting set  admin_email = ? , app_name = ?  where id = 1');
    $st->bind_param('ss' , $bdAdminEmail , $dbAppName);
    $bdAdminEmail = $_POST['admin_email'];
    $dbAppName = $_POST['app_name'];
    $st->execute();

    echo "<script>location.href ='index.php'</script>";


}
?>

    <div class="card">

    <div class="content">
    <form action="" method="post">

        <h3>Update Setting</h3>

        <div class="form-group">
            <label for="app_name">App name:</label>
            <input type="text" name="app_name" value="<?php echo $config['app_name'] ?>" id="app_name"
                   class="form-control">
        </div>

        <div class="form-group">
            <label for="admin_email">Admin email:</label>
            <input type="email" name="admin_email" value="<?php echo $config['admin_email'] ?>" id="admin_email"
            class="form-control">
        </div>

        <div class="form-group">
            <button class="btn btn-success">Update setting</button>
        </div>
    </form>


<?php
include __DIR__ . '/../template/footer.php';

