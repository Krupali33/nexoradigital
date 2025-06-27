<?php
/*
Name: 			Contact Form
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version:	7.4.0
*/

namespace PortoContactForm;

session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));

header('Content-type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php-mailer/src/PHPMailer.php';
require 'php-mailer/src/SMTP.php';
require 'php-mailer/src/Exception.php';

// Step 1 - Enter your email address below.
$email = 'info@wadhwacourtyard.com'; //'info@hayoungroup.com';


// If the e-mail is not working, change the debug option to 2 | $debug = 2;
$debug = 0;

// If contact form don't has the subject input change the value of subject here

if ( isset($_GET['s']) )
{
?>

<script language="javascript">alert('Mail send successfully..');</script>	
<?php	
}


$message = '';

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

	$mail->IsSMTP();                                         // Set mailer to use SMTP
	$mail->Mailer = "smtp";
	$mail->Host = 'mail.hayoungroup.com';
	
/*	$mail->SMTPDebug = $debug;                                 // Debug Mode

	// Step 2 (Optional) - If you don't receive the email, try to configure the parameters below:




	$mail->IsSMTP();                                         // Set mailer to use SMTP
	$mail->Mailer = "smtp";
	$mail->Host = '43.255.154.112'; //mail.hayoungroup.com';				       // Specify main and backup server
	$mail->SMTPAuth = true;                                  // Enable SMTP authentication
	$mail->Username = 'info@hayoungroup.com';                    // SMTP username
	$mail->Password = '[G1VRYeM[tPj';                              // SMTP password
	$mail->SMTSecure = 'tls';                               // Enable encryption, 'ssl' also accepted
	$mail->Port = 587; 
	
*/	
	//echo "Stage 1";
	//exit;
	
  								       // TCP port to connect to

	$mail->AddAddress($email);	 						       // Add another recipient

	$mail->AddAddress('info@wadhwacourtyards.com', 'Person 2');     // Add a secondary recipient
//	$mail->AddCC('info@phoenixlinked.com', 'Person 3');          // Add a "Cc" address. 
	//$mail->AddBCC('person4@domain.com', 'Person 4');         // Add a "Bcc" address. 

	// From - Name
	$fromName = ( isset($_POST['myname']) ) ? $_POST['myname'] : 'Website User';
	$mail->SetFrom($email, $fromName);
	$mail->Subject = "GK - Website : Enquiry Received From  PhoenixLinked.com Website"; 
	
	
	// Repply To
	if( isset($_POST['myemail']) ) {
		//$mail->AddReplyTo($_POST['myemail'], $fromName);
		$mail->AddReplyTo('info@wadhwacourtyards.com', $fromName);
	}

    //echo "Stage 2";
    //echo "</br>fromName:" . $fromName;
    //echo "</br>fromemail:" . $email;
	//exit;
	
	$mail->IsHTML(true);                                       // Set email format to HTML

	$mail->CharSet = 'UTF-8';

	//$mail->Subject = $subject;
	$mail->Body    = $message;
	
	
//	echo "Stage 3 </br>";
//	echo $message;
	//exit;

//	$mail->Send();
	//header("Location: http://wadhwacourtyards.com");
	
	
	
	//exit();
	//$arrResult = array ('response'=>'success' );
	

} catch (Exception $e) {
	$arrResult = array ('response'=>'error','errorMessage'=>$e->errorMessage());
} catch (\Exception $e) {
	$arrResult = array ('response'=>'error','errorMessage'=>$e->getMessage());
}

if ($debug == 0) {
	echo json_encode($arrResult);
}




?>

<?php //header("Location: http://wadhwacourtyards.com");

die();

?>
