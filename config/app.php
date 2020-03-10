<?php
include_once 'database.php';

$setting = $mysqli->query('select * from setting where id = 1')->fetch_assoc();


if (count($setting)){
    $app_name = $setting['app_name'];
    $admin_email = $setting['admin_email'];
}else{
    $app_name = 'MgStore';
    $admin_email = 'abdulrahmankkn@gmail.com';
}
$config = [
        'app_name' => $app_name,
        'admin_email'=> $admin_email,
        'lang' => 'en',
        'dir' => 'ltr',
        'app_url' => 'http://127.0.0.1/AAAA/',
        'upload_dir' => 'uploads/',
        'admin_assets' => 'http://127.0.0.1/AAAA/admin/template/BS3/assets'

];