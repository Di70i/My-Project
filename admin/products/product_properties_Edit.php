<?php
$title='Edit Services';
$icon='cubes';
include __DIR__ . '/../template/header.php';

if (!isset($_GET['id']) || !$_GET['id']) {
    die("Missing id parameter");
}

$product_id = $_GET['id'];
$color = '';
$size = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $color=mysqli_real_escape_string($mysqli, $_POST['color']);
    $size=mysqli_real_escape_string($mysqli, $_POST['size']);

    if (empty($color)) {
        array_push($errors, "Name is required");
    }
    if (empty($size)) {
        array_push($errors, "Description is required");
    }


    if (!count($errors)) {

        $query="insert into stock (product_id , color , size ) values ('$product_id','$color' , '$size')";
        $mysqli->query($query);

        if ($mysqli->error) {
            array_push($errors, $mysqli->error);
        } else {
            echo "<script>location.href = 'index.php'</script>";
        }
    }

}

?>

    <div class="card">
        <div class="content">
            <?php include __DIR__ . '/../template/errors.php'; ?>
            <form action="" method="post">

                <div class="from-group">
                    <label for="name">Color:</label>
                    <input type="text" name="color" class="form-control" id="name"
                           value="<?php echo $color ?>">
                </div>
                <br>
                <div class="from-group">
                    <label for="name">Size:</label>
                    <input type="text" name="size" class="form-control"  id="name"
                           value="<?php echo $size ?>">
                </div>
                <br>
                <br>
                <div class="from-group">
                    <button class="btn btn-success">Update!</button>
                </div>
            </form>
        </div>
    </div>
<?php
include __DIR__ . '/../template/footer.php';
