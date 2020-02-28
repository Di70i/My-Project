<?php
$title = 'Users';
$icon = 'users';
include __DIR__.'/../template/header.php';

$users = $mysqli->query('select * from users order by id')->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $st = $mysqli->prepare('delete from users where id = ?');
    $st->bind_param('i' , $user_Id);
    $user_Id = $_POST['user_id'];
    $st->execute();
    echo "<script>location.href = 'index.php'</script>";
}
?>

<div class="card">

    <div class="content">



        <a href="crerate.php" class="btn btn-success">Create a new user</a>
        <p class="header" style="font-size: 20px; color: goldenrod">Users:<?php echo count($users)?></p>

        <div class="table-responsive">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Email</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th width="170">action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id'] ?></td>
                        <td><?php echo  $user['email'] ?></td>
                        <td><?php echo  $user['name'] ?></td>
                        <td><?php echo  $user['role'] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $user['id']?>" class="btn btn-warning">Edit</a>
                            <form action="" method="post" style="display: inline">
                                <input type="hidden" value="<?php echo $user['id']?>" name="user_id">
                                <button onclick="return confirm('Are you sure ?')" class="btn btn-danger" type="submit">Delete</button>
                            </form>

                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>

        </div>

    </div>
</div>
<?php
include __DIR__.'/../template/footer.php';

