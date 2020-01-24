<?php
require_once __DIR__."/../config/database.php";
$uploadDir = 'uploads';

function filterString($field){
    $field = filter_var(trim($field),FILTER_SANITIZE_STRING);
    if (empty($field)){
        return false;
    } else{
        return $field;
    }
}

function filterEmail($field){
    $field = filter_var(trim($field),FILTER_SANITIZE_EMAIL);
    if(filter_var($field, FILTER_VALIDATE_EMAIL)){
        return $field;
    }else{
        return false;
    }
}
function canUpload($file){
    $allowed = [
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif'
    ];

    $maxFileSize = 10 * 1024 * 1024;

    $fileMimeType = mime_content_type($file['tmp_name']);

    $fileSize = $file['size'];

    if (!in_array($fileMimeType, $allowed)){
        return 'File type is not allowed';
    };

    if ($fileSize > $maxFileSize){
        return 'File size is not allowed';
    }
    return true;
}

$nameError = $emailError = $messageError = $documentError = '';
$name = $email = $message = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $name = filterString($_POST['name']);
    if(!$name){
        $_SESSION['contact_form']['name'] = '';
        $nameError = 'Your Name is required';
    }else{
        $_SESSION['contact_form']['name'] = $name;
    }

    $email = filterEmail($_POST['email']);
    if (!$email){
        $_SESSION['contact_form']['email'] = '';
        $emailError = 'Your email is invalid';
    }else{
        $_SESSION['contact_form']['email'] = $email;
    }

    $message = filterString($_POST['message']);
    if (!$message){
        $_SESSION['contact_form']['message'] = '';
        $messageError = 'You must enter a message';
    }else{
        $_SESSION['contact_form']['message'] = $message;
    }


    if(isset($_FILES['document']) && $_FILES['document']['error'] == 0){

        $canUpload = canUpload($_FILES['document']);

        if($canUpload === true){

            if(!is_dir($uploadDir)){
                umask(0);
                mkdir($uploadDir, 0777);
            }

            $fileName = time().$_FILES['document']['name'];
            if (file_exists($uploadDir.'/'.$fileName)){
                $documentError = 'File already exists';
            }else{
                move_uploaded_file($_FILES['document']['tmp_name'],$uploadDir.'/'.$fileName);
            }

        }else{
            $documentError = $canUpload;

        }

    }

    if (!$nameError && !$emailError && !$messageError && !$documentError) {

        $fileName ? $filePath = $uploadDir.'/'.$fileName : $filePath = '';
        $insertMessage =
            "insert into messages (contact_name, email, document, message ,service_id)".
            "values ('$name','$email','$fileName','$message', ".$_POST['service_id']." )";

        $mysqli->query($insertMessage);


        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

        $headers .='From: ' .$email."\r\n".
            'Reply-To: '.$email."\r\n".
            'X-Mailer: PHP/' . phpversion();

        $htmlMessage = '<html><body>';
        $htmlMessage .= '<p style="color:#ff0000;">'. $message .'</p>';
        $htmlMessage .= '</body></html>';

        if(mail($config['admin_email'],"Welcome",$message)){
            session_destroy();
            header('Location: contact.php');
            die();
        }else {
            echo "Error sending your email";
        }

    }


}