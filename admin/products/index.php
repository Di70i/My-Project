<?php
$title='products';
$icon='dropbox';
include __DIR__ . '/../template/header.php';

$products=$mysqli->query('select * from products order by id')->fetch_all(MYSQLI_ASSOC);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $st=$mysqli->prepare('delete from stock where product_id = ?');
    $st->bind_param('i', $product_Id);
    $product_Id=$_POST['product_id'];
    $st->execute();

    $st=$mysqli->prepare('delete from products where id = ?');
    $st->bind_param('i', $product_Id);
    $product_Id=$_POST['product_id'];
    $st->execute();

    if ($_POST['image']) {
        unlink($_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'AAAA' . $_POST['image']);

    }

    echo "<script>location.href = 'index.php'</script>";
}

?>

    <style>
        .dro {
            background-color: black;
            color: #f9f9f9;
            text-align: center;
        }
        .drop_item {
            font-size: 13px;
            color: black;
            text-align: center;
        }
    </style>
    <div class="card">

        <div class="content">


            <a href="crerate.php" class="btn btn-success">Create a new product</a>
            <p class="header" style="font-size: 20px; color: goldenrod">product:<?php echo count($products) ?></p>

            <div class="table-responsive">

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Quantity</th>
                        <th>name</th>
                        <th>description</th>
                        <th>Product Properties</th>
                        <th>price</th>
                        <th>image</th>
                        <th width="170">action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id'] ?></td>
                            <td><?php echo $product['Quantity'] ?></td>
                            <td><?php echo $product['name'] ?></td>
                            <td><?php echo $product['description'] ?></td>
                            <td>
                            <a href="product_properties_Edit.php?id=<?php echo $product['id']?>"><button class="btn btn-primary">أضافة خصائص المنتج</button></a>
                            </td>
                            <td><?php echo $product['price'] ?></td>
                            <td><img src="<?php echo $config['app_url'] . '/' . $product['image'] ?>" width="70"
                                     height="70"></td>

                            <td>
                                <a href="edit.php?id=<?php echo $product['id']?>" class="btn btn-warning">Edit</a>
                                <form action="" method="post" style="display: inline">
                                    <input type="hidden" value="<?php echo $product['id']?>" name="product_id">
                                    <input type="hidden" value="<?php echo $product['image']?>" name="image">
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
include __DIR__ . '/../template/footer.php';

