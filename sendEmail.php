<?php
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['name']) && isset($_POST['email'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    $subject = $_POST['subject'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();
    //smtp setting
    $mail -> isSMTP();
    $mail -> Host = "smtp.gmail.com";
    $mail -> SMTPAuth = true;
    $mail -> Username = "butaram1978@gmail.com";
    $mail -> Password = "parduman@123";
    $mail -> Port = 465;
    $mail -> SMTPSecure = "ssl";
    //email setting 
    $mail -> isHTML(true);
    $mail -> setFrom($email, $name);
    $mail -> addAddress("butaram1978@gmail.com");
    $mail -> Subject = ("$email ($subject)");
    $mail -> Body = $message;

    if($mail -> send()){
        $status = "Success";
        $response = "Email is sent!";
    }
    else{
        $status = "Failed!";
        $response = "Something is wrong: <br>".$mail -> ErrorInfo;
    }
    exit(json_encode(array("status" => $status, "response" => $response)));
}
?>