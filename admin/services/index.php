<?php
$title = 'Services';
$icon = 'cubes';
include __DIR__.'/../template/header.php';

$services = $mysqli->query('select * from services order by id')->fetch_all(MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $st = $mysqli->prepare('delete from services where id = ?');
    $st->bind_param('i' , $user_Id);
    $service_ID = $_POST['service_id'];
    $st->execute();
    echo "<script>location.href = 'index.php'</script>";
}
?>

<div class="card">

    <div class="content">



        <a href="crerate.php" class="btn btn-success">Create a new service</a>
        <p class="header" style="font-size: 20px; color: goldenrod">Services:<?php echo count($services)?></p>

        <div class="table-responsive">

            <table class="table table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>name</th>
                    <th>description</th>
                    <th>price</th>
                    <th width="170">action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($services as $service): ?>
                    <tr>
                        <td><?php echo $service['id'] ?></td>
                        <td><?php echo  $service['name'] ?></td>
                        <td><?php echo  $service['description'] ?></td>
                        <td><?php echo  $service['price'] ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $services['id']?>" class="btn btn-warning">Edit</a>
                            <form action="" method="post" style="display: inline">
                                <input type="hidden" value="<?php echo $services['id']?>" name="service_id">
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

