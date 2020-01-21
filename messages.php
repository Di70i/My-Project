<?php
$title = 'Messages';
require_once 'template/header.php';
require_once 'config/app.php';
require_once 'config/database.php';

$query = "select *, m.id as message_id
        , s.id service_id from messages m
        left join services s
        on m.service_id = s.id
        order by m.id
            ";
$messages = $mysqli->query($query)
    ->fetch_all(MYSQLI_ASSOC)
?>
<?php
if(!isset($_GET['id'])){
    ?>
    <h2>Received Messages</h2>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Sender Name</th>
                <th>Sender Email</th>
                <th>Service</th>
                <th>messages</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach($messages as $message) {
                ?>
                <tr>
                    <td><?php echo $message['message_id']  ?></td>
                    <td><?php echo $message['contact_name']  ?></td>
                    <td><?php echo $message['email']  ?></td>
                    <td><?php echo $message['name']  ?></td>
                    <td><?php echo $message['document']  ?></td>
                    <td>
                        <a href="?id=<?php echo $message['message_id']?>" class="btn btn-sm btn-primary">View</a>

                        <form onsubmit="return confirm('Are you sure?')" action="" method="post" style="display: inline-block">
                            <input type="hidden" name="message_id" value="<?php echo $message['message_id']?>">
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

<?php }else{
    $messageQuery = "select * from messages m
                         left join services s 
                         on m.service_id = s.id
                         where m.id=" . $_GET['id'] . " limit 1";
    $message = $mysqli->query($messageQuery)->fetch_array(MYSQLI_ASSOC);
    ?>
    <div class="card">
        <h5 class="card-header">
            Message From : <?php echo $message['contact_name'] ?>
            <div class="small"><?php echo $message['contact_name']  ?></div>
            <div class="small"><?php echo $message['email'] ?></div>
        </h5>
        <div class="card-body">
            <div>Service : <?php if ($message['name']){ echo $message['name'];}else{'No Service';}?></div>
            <?php echo $message['message'] ?>
        </div>
        <?php if ($message['document']) { ?>
            <div class="card-footer">
                Attachment: <a href="<?php
                echo $config['app_url']
                    .$config['upload_dir']
                    .$message['document']?>">Download Attachment</a>
            </div>
        <?php } ?>
    </div>
    <?php
}
if (isset($_POST['message_id'])){
    $mysqli->query("delete from messages where id=" .$_POST['message_id']);
    header('location: messages.php');
    die();
} ?>

<?php
require_once 'template/footer.php';
?>