
<?php
/*
Name: 			Contact Form
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version:	7.4.0
*/


session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));

header('Content-type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php-mailer/src/PHPMailer.php';
require 'php-mailer/src/SMTP.php';
require 'php-mailer/src/Exception.php';

// Step 1 - Enter your email address below.
$email = 'jaffarh701@gmail.com';

// If the e-mail is not working, change the debug option to 2 | $debug = 2;
$debug = 0;

// If contact form don't has the subject input change the value of subject here


$message = '';
//print_r($_POST);exit();
foreach($_POST as $label => $value) {
	$label = ucwords($label);

	// Use the commented code below to change label texts. On this example will change "Email" to "Email Address"

	// if( $label == 'Email' ) {               
	// 	$label = 'Email Address';              
	// }

	// Checkboxes
	if( is_array($value) ) {
		// Store new value
		$value = implode(', ', $value);
		
	}

	$message .= $label.": " . htmlspecialchars($value, ENT_QUOTES) . "<br>\n";
}


$mail = new PHPMailer(true);

try {

	$mail->SMTPDebug = $debug;                                 // Debug Mode

	// Step 2 (Optional) - If you don't receive the email, try to configure the parameters below:

	$mail->IsSMTP();                                         // Set mailer to use SMTP
	$mail->Mailer = "smtp";
	$mail->Host = 'mail.acinstallationmumbai.in';				       // Specify main and backup server
	$mail->SMTPAuth = true;                                  // Enable SMTP authentication
	$mail->Username = 'info@acinstallationmumbai.in';                    // SMTP username
	$mail->Password = 'Ahsg2LY6xU3O';                              // SMTP password
	$mail->SMTSecure = 'tls';                               // Enable encryption, 'ssl' also accepted
	$mail->Port = 587; 
	
	
  								       // TCP port to connect to

	$mail->AddAddress($email);	 						       // Add another recipient

	//$mail->AddAddress('person2@domain.com', 'Person 2');     // Add a secondary recipient
	//$mail->AddCC('person3@domain.com', 'Person 3');          // Add a "Cc" address. 
	//$mail->AddBCC('person4@domain.com', 'Person 4');         // Add a "Bcc" address. 

	// From - Name
	$fromName = ( isset($_POST['name']) ) ? $_POST['name'] : 'Website User';
	
	$mail->Subject = "Website : Enquiry Received From  Kumar AC Installation in Mumbai"; 
	//$mail->SetFrom($email, $fromName);
	$mail->SetFrom($_POST['email'], $fromName);
	
	
	
	// Repply To
	if( isset($_POST['email']) ) {
		$mail->AddReplyTo($_POST['email'], $fromName);
		
		
	}
	
	$mail->IsHTML(true);                                       // Set email format to HTML

	$mail->CharSet = 'UTF-8';

	//$mail->Subject = $subject;
	$mail->Body    = $message;
	
	
	

	$mail->Send();
	header("Location: https://jf.bstarsw.in/acservices");
	exit();
	$arrResult = array ('response'=>'success' );
	

} catch (Exception $e) {
	$arrResult = array ('response'=>'error','errorMessage'=>$e->errorMessage());
} catch (\Exception $e) {
	$arrResult = array ('response'=>'error','errorMessage'=>$e->getMessage());
}

if ($debug == 0) {
	echo json_encode($arrResult);
}


?>

<?php header("Location: https://jf.bstarsw.in/acservices");

die();


?>