<?php
session_start();
include'../admin/php/db_connection.php';

$email = $_POST['email'];

$email2 = md5($email);

//<a href='http://uopitracer-001-site1.anytempurl.com/reset_pass.php?id=$email2'>Reset My Password</a>
$message = "Click the link below to reset your password.
<br><br>
<a href='http://uopitracer.esy.es/reset_pass.php?id=$email2'>Reset My Password</a>
";

require("../admin/php/PHPMailer-master/PHPMailerAutoload.php"); 
ini_set("SMTP","ssl://smtp.gmail.com"); 
ini_set("smtp_port","465"); 
$mail = new PHPMailer();
$mail->isHTML(true);
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com"; 
$mail->SMTPSecure = "ssl";
$mail->Username = "remo.lalata2@gmail.com"; 
$mail->Password = "remolalata1995new"; 
$mail->Port = "465";
$mail->isSMTP();  
$rec1="$email";
$mail->AddAddress($rec1);
$mail->Subject  = "UPang Alumni Tracer";
$mail->Body     = "$message";
$mail->WordWrap = 200;
if(!$mail->Send()) {
echo 'Message was not sent!.';
echo 'Mailer error: ' . $mail->ErrorInfo;
} else {

$_SESSION['alert'] = 2;
header("Location: ../login.php");

}

?>
