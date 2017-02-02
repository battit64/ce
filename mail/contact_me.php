<?php

require 'PHPMailerAutoload.php';

//Check for empty fields
if(empty($_POST['name'])  		||
   empty($_POST['email']) 		||
   empty($_POST['phone']) 		||
   empty($_POST['message'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
   {
	echo "No arguments Provided!";
	return false;
   }
	
$name = strip_tags(htmlspecialchars($_POST['name']));
$email_address = strip_tags(htmlspecialchars($_POST['email']));
$phone = strip_tags(htmlspecialchars($_POST['phone']));
$message = strip_tags(htmlspecialchars($_POST['message']));
	
	

// Create the email and send the message
$to = 'ce@pyrenees.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Contact depuis le site du CE:  $name";
$email_body = "Vous avez reçu un message depuis le formulaire de contact du site du CE.\n\n"."Voici les détails\n\nName: $name\n\nEmail: $email_address\n\nPhone: $phone\n\nMessage:\n$message";
$headers = "From: ce@pyrenees.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email_address";	
//mail($to,$email_subject,$email_body,$headers);


//version2 sans sendmail
$send_using_gmail=true;

$mail = new PHPMailer();

//Send mail using gmail
if($send_using_gmail){
	$mail->SMTPDebug = 4;
    //$mail->IsSMTP(); // telling the class to use SMTP
	  $mail->Host = "ssl://smtp.gmail.com"; // sets GMAIL as the SMTP server
    $mail->SMTPAuth = true; // enable SMTP authentication
    $mail->SMTPSecure = "tls"; // sets the prefix to the servier
	   $mail->Username = "ce@pyrenees.com"; // GMAIL username
    $mail->Password = "republique64000"; // GMAIL password
  
    $mail->Port = 587; // set the SMTP port for the GMAIL server
 
}

//Typical mail data
 $mail->isHTML(true);
$mail->From = $to;
$mail->FromName = $name;
$mail->addAddress($to, 'Recipients Name');/*Add a recipient*/
$mail->addReplyTo($email_address, $name);
/*$mail->addCC('cc@example.com');*/

//$mail->AddAddress($to, $name);
//$mail->SetFrom($email_address , $name);

$mail->MsgHTML($email_body);
 $mail->Subject = $email_subject;
 $mail->MsgHTML($email_body);

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
	return true;
    //echo "Message sent!";
	
}



//return true;			
?>
