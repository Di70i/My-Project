<?php
$title = 'Contact';
require_once 'template/header.php';
require_once ('includes/uploader.php');
require 'classes/Service.php';

if (isset($_SESSION['contact_form'])) {
    ($_SESSION['contact_form']);
}
$s = new Service;
$s->taxRate = .05;

$services = $mysqli->query("select id, name, price from services order by id ")

    ->fetch_all(MYSQLI_ASSOC);
?>
<?php if ($s->available) { ?>
    <h1>Contact us</h1>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <div  class="form-group">
            <label for="name"> Your name</label>
            <input type="text" name="name" value="<?php if(isset($_SESSION['contact_form']['name'])) echo $_SESSION['contact_form']['name'] ?> "class="form-control" placeholder="Your name">
            <span class="text-danger"><?php echo $nameError ?></span>
        </div>
        <div class="form-group">
            <label for="email">Your email</label>
            <input type="email" name="email" value="<?php if(isset($_SESSION['contact_form']['email'])) echo $_SESSION['contact_form']['email'] ?> "class="form-control" placeholder="Your email">
            <span class="text-danger"><?php echo $emailError ?></span>
        </div>
        <div class="form-group">
            <label for="document">Your document</label>
            <input type="file" name="document">
            <span class="text-danger"><?php echo $documentError ?></span>
        </div>


        <div class="form-group">
            <label for="services">Services</label>
            <select name="service_id" id="services" class="form-control">
                <?php foreach($services as $service) {?>
                    <option value="<?php echo $service['id'] ?>">
                        <?php echo $service['name'] ?>
                        (<?php echo $s->price($service['price']) ?>) SAR
                    </option>
                <?php } ?>
            </select>
        </div>


        <div class="form-group">
            <label for="message">Your message</label>
            <textarea name="message" class="form-control" placeholder="Your message"><?php if(isset($_SESSION['contact_form']['$messageError']))echo $_SESSION['contact_form']['message'] ?></textarea>
            <span class="text-danger"><?php echo $messageError ?></span>
        </div>
        <button class="btn btn-primary">Send</button>
    </form>
<?php } ?>
<?php

require_once 'template/footer.php';
?>