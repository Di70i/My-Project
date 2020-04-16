<?php
session_start();
require_once 'template/header.php';
require 'config/app.php';
require_once 'config/database.php';
$AllCartTotal=0;

$total = 0;
$TPS = 0;
$name = '';
if(isset($_SESSION['cart'])){
    $pp = implode(',', array_column($_SESSION['cart'] ,  'id'));
    $products=$mysqli->query("select * from products ")->fetch_all(MYSQLI_ASSOC);



//if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $st=$mysqli->prepare('UPDATE `products` SET stock = stock - 1 where id = ?');
//        $st->bind_param('i', $product_Id);
//        $product_Id=$_POST['product_id'];
//         $st->execute();
//
//
//    }
?>


    <style>
        body{
            background:#eee;
        }
    </style>


    <div class="container">
        <div class="row">
            <div class="col-sm-12  col-md-offset-1">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  foreach ($products as $key => $cart){ ?>

                        <tr>
                            <td class="col-sm-8">
                                <div class="media">
                                    <a class="thumbnail pull-left" href="#"> <img class="media-object" src="<?php echo $config['app_url'] . $cart['image']?>" style="width: 80px; height: 80px;"> </a>
                                    <div class="media-body">
                                        <h4 class="media-heading "><a href="#"><?php echo $cart['name']?></a></h4>
                                    </div>
                                </div>
                            </td>
                            <td class="col-sm-12 col-md-1" style="text-align: center">
                                <input type="number" id="quantity" name="quantity" value="1" class="text-center" style="width: 40px;height: 30px;">
                                <snap class="text-danger d-inline">Stock:<?php echo $cart['stock']?></snap>
                            </td>
                            <td class="col-sm-1 col-md-1 text-center"><strong><?php echo $cart['price']?></strong></td>
                            <?php $TPS =  $cart['price'] * $cart['stock']?>
                            <td class="col-sm-1 col-md-1 text-center"><strong><?php  echo $TPS ?></strong></td>
                            <?php $AllCartTotal += $TPS  ?>
                            <td class="col-sm-1 col-md-1">
                                <a href="shopping_card.php">
                                    <form name="delete_product" action="" method="post">
                                        <button type="button" class="btn btn-sm btn-danger">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </form>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Subtotal</h5></td>
                        <td class="text-right"><h5><strong>$24.59</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h5>Estimated shipping</h5></td>
                        <td class="text-right"><h5><strong>$6.94</strong></h5></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td><h3>Total</h3></td><td class="text-right"><h3><strong><?php echo $AllCartTotal?></strong></h3></td>
                    </tr>
                    <tr>
                        <td>   </td>
                        <td>   </td>
                        <td>   </td>
                        <td>
                            <a href="<?php echo $config['app_url']?>">
                                <button type="button" class="btn btn-default">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Continue Shopping
                                </button>
                            </a>
                        </td>
                        <td>
                            <button type="button" name="" class="btn btn-success">
                                Checkout <span class="glyphicon glyphicon-play"></span>
                            </button></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>




<?php } ?>

