<?php
if(isset($_POST['email'])) {
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = $_POST['email'];
    $email_subject = "Demande de service";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['organisation']) ||
        //!isset($_POST['email']) ||
        !isset($_POST['phone']) ||
        !isset($_POST['message'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
    $name = $_POST['name']; // required
    $organisation = $_POST['organisation']; // required
    $email_from = "nediamrabti2017@gmail.com"; // required
    $phone = $_POST['phone']; // not required
    $message = $_POST['message']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
	if(!preg_match($email_exp,$email_from)) { $error_message .= 'L''adresse email n''est pas valide.<br />';}
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
	if(!preg_match($string_exp,$name)) { $error_message .= 'Le nom n''est pas valide.<br />'; }
 
	if(!preg_match($string_exp,$organisation)) { $error_message .= 'Le nom de l''organisation n''est pas valide.<br />'; }
 
	if(strlen($message) < 2) { $error_message .= 'Le message n''est pas valide.<br />'; }
 
	if(strlen($error_message) > 0) { died($error_message); }
 
    $email_message = "Form details below.\n\n";
 
     
    function clean_string($string) {	
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Nom: ".clean_string($name)."\n";
    $email_message .= "Organisation: ".clean_string($organisation)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "T�l�phone: ".clean_string($phone)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Merci pour votre confiance. Nous allons vous contacter dans les plus brefs d�lais.
 
	<?php
 
	} 
?>