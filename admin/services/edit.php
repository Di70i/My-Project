<?php
$title='Edit Services';
$icon='cubes';
include __DIR__ . '/../template/header.php';

if (!isset($_GET['id']) || !$_GET['id']) {
    die("Missing id parameter");
}

$st=$mysqli->prepare('select * from services where id = ? limit 1');
$st->bind_param('i', $servicesId);
$servicesId = $_GET['id'];
$st->execute();

$services = $st->get_result()->fetch_assoc();

$name = $services['name'];
$description = $services['description'];
$price = $services['price'];

$errors=[];


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST['name'])){array_push($errors, "Email is required");}
    if (empty($_POST['description'])){array_push($errors, "description is required");}
    if (empty($_POST['price'])){array_push($errors, "price is required");}


    if (!count($errors)) {
        $st=$mysqli->prepare('update services set name = ?, description = ?, price = ? where id = ?');
        $st->bind_param('ssdi', $dbName, $dbDescription, $dbPrice, $dbId);
        $dbName=$_POST['name'];
        $dbDescription=$_POST['description'];
        $dbPrice=$_POST['price'];
        $dbId = $_GET['id'];

        $st->execute();

        if ($st->error) {
            array_push($errors, $st->error);
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
                    <label for="name">Name service:</label>
                    <input type="text" name="name" class="form-control" placeholder="Your name" id="name"
                           value="<?php echo $name ?>">
                </div>
                <br>
                <div class="from-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description"
                              class="form-control"><?php echo $description ?></textarea>
                </div>
                <br>

                <div class="from-group">
                    <label for="price">Price:</label>
                    <input type="number" name="price" class="form-control" id="price" value="<?php echo $price ?>">
                </div>
                <br>
                <div class="from-group">
                    <button class="btn btn-success">Update!</button>
                </div>
            </form>
        </div>
    </div>
<?php
include __DIR__ . '/../template/footer.php';
