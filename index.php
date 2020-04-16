<?php
session_start();

$title="البضائع";
require_once 'template/header.php';
require 'classes/Service.php';
require 'classes/Product.php';
require 'config/app.php';
require_once 'config/database.php';

$products=$mysqli->query("select * from `products` order by name")->fetch_all(MYSQLI_ASSOC) ;


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
        .row{
            font-size: 14px;
            font-style: normal;
            font-weight: 700;
            color: #000;
            line-height: 1.5;
        }

        #a {
            text-decoration: none;
            color: black;
        }
    .btn {
        display: block;
        padding: 5px;
        color: #fff;
        margin: 10px 0 0;
        width: 100%;
        border-radius: 2px
    }
        .BTN_cart{
            color: #FFFFFF;

        }
        .fas{
            color: #101010;
        }

</style>
<form method="get" action="">
    <div class="row">

    <?php foreach ($products as $product) { ?>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="">
                <div class="card-body">
                    <a id="a" href="viprodcts.php?id=<?php echo $product['id'] ?>">
                        <div class="custom-card-image"
                             style="background-image: url('<?php echo $config['app_url'] . $product['image'] ?>')"></div>
                        <div class="card-body text-left mr-auto">
                            <div class="card-title"><h4><?php echo $product['name'] ?></h4></div>
                            <div style="color: #676767" class=""><?php echo $product['price'] ?> SR</div>
                            <a class="btn btn-sm pb-5 text-center btn text-success BTN_cart" href="?id=<?php echo $product['id'] ?>">
                                    Add to cart<i class="fas fa-shopping-cart"></i>
                            </a>
               </a>
                </div>
            </div>
        </div>
        </div>
    <?php } ?>
    </div>
</form>
    <?php
require_once 'template/footer.php' ?>