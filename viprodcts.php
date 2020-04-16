<?php
session_start();
require_once 'template/header.php';
require_once 'config/database.php';

$Pid=($_GET['id']);

if ($Pid == false) {

    echo 'error funding the id of the product';
}
$products=$mysqli->query("select * from products where id='$Pid' ")->fetch_all(MYSQLI_ASSOC);

$stock = $mysqli->query("SELECT * FROM `stock` where product_id = '$Pid' ")->fetch_all(MYSQLI_ASSOC);

$ex = '<p class="text-success text-center" style="font-size: 20px;display: inline">متوفر</p>';
$not_ex = '<p class="text-danger text-center" style="font-size: 22px;display: inline"> غير متوفر</p>';



if (isset($_GET['id'])){

    if (isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'] , 'id');

        if (in_array($_GET['id'],$item_array_id)){
            echo "<script>alert('Product already add in the cart..!')</script>";
            echo "<script>window.location = 'index.php</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'id' => $_GET['id']
            );

            $_SESSION['cart'][$count] = $item_array;

        }
    }else{
        $item_array = array(
            'id' => $_GET['id']
        );

        $_SESSION['cart'][0] = $item_array;
    }
}
?>
<style>
    .card-title{
     font-size: 28px;
    }
    .price{
     font-size: 16px;
    }
    .CT1{
     font-size: 13px;
    }
</style>

<div class="card mb-3" >
    <div class="row no-gutters">
<?php foreach ($products as $key => $PV):?>
        <div class="col-md-5 col-sm-12">
            <img src="<?php echo $config['app_url'] . $PV['image']?>" height="500" width="400" class="card-img " alt="...">
        </div>

        <div class="col-md-7 col-sm-12">
            <div class="card-body pb-5">
                <p class="card-title"><?php echo $PV['name']?></p>
                <p class="card-text CT1"><?php echo $PV['description']?></p>
                <p class="card-text price text-success"><?php echo $PV['price']?> SRA</p>

                <label for="stock">Size:</label>
                <br>
                <select name="stock" id="stock" class="form-control w-25">
                    <?php foreach ($stock as $size){?>
                        <option value="">
                            <?php echo $size['size'] ?>
                        </option>
                    <?php } ?>
                </select>

<?php endforeach; ?>

                <br>
                <label for="quantity">Quantity:</label>
                <br>
                <input type="number" id="quantity" name="quantity" value="1" class="text-center">
                <br>
                <br>

                <a class="btn btn-success btn-sm text-center" href="shopping_card.php?id=<?php echo $product['id'] ?>">>
                    Add to cart<i class="fas fa-shopping-cart" style="color: black"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php
?>
