<?php

//This scripts handles the 'Ask us a question' form on help.html, the functionality allows for the form to be filled out and the query is sent
//to a helpdesk 'covinfomailbox@gmail.com' along with the senders address to use for the reply.

require_once('SMTP.php');
require_once('PHPmailer.php'); //include & require files from PHPMailer class
require_once('Exception.php');


$from = $_POST['reply_add']; //senders e-mail address to use for reply, POST from form
$query = $_POST['query']; //senders query, POST from form
$subject = "Query - $from"; //subject, incldues from address
$message = "$query\n\nPlease send response to $from"; //msg = query + from address
$headers = "From:" . $from; 

use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

$mail=new PHPMailer(true); 

try {
    $mail->isSMTP(); //use smtp
    $mail->Host='smtp.gmail.com'; 
    $mail->SMTPAuth=true; 
    $mail->Username='covinfomailbox@gmail.com'; //gmail credentials, a more secure solution would require OAuth 2.0
    $mail->Password='justapassword';
    $mail->SMTPSecure='ssl';
    $mail->Port=465;

    $mail->setFrom($from);


    $mail->addAddress('covinfomailbox@gmail.com', 'covinfosupport'); 



    $mail->Subject=$subject;
    $mail->Body=$message;

    $mail->send();

    echo 'Message has been sent';
} 
catch(Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: '.$mail->ErrorInfo;
}

header("Location: http://localhost/html/query_rec.html"); //redirect to confirmation page

?>

