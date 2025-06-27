<?php
if (isset($_POST['myname'])) {
    $myname = strip_tags($_POST['myname']);
    $myemail = strip_tags($_POST['myemail']);
    $mysubject = htmlentities($_POST['mysubject']);
    $mymessage = htmlentities($_POST['mymessage']);

    $subject = $myname . " : Enquiry Received from Website";

    $mailcontent  = '<html><body>';
    $mailcontent .= '<table rules="all" border="1" style="border-color: #666;" cellpadding="10">';
    $mailcontent .= "<tr style='background: #eee;'><td><strong>Name:</strong> </td><td>" . $myname . "</td></tr>";
    $mailcontent .= "<tr><td><strong>Email:</strong> </td><td>" . $myemail . "</td></tr>";
    $mailcontent .= "<tr><td><strong>Subject:</strong> </td><td>" . $mysubject . "</td></tr>";
    $mailcontent .= "<tr><td><strong>Message:</strong> </td><td>" . $mymessage . "</td></tr>";
    $mailcontent .= "</table>";
    $mailcontent .= "<br><strong>Thank you for contacting us!</strong><br>";
    $mailcontent .= "<a href='https://www.nexoradigital.co.in/'>Visit our site</a>";
    $mailcontent .= '</body></html>';

    $to = "jaffarh701@gmail.com";
    $headers = "MIME-Version: 1.0\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8\r\n";
    $headers .= "From: jaffarh701@gmail.com\r\n";
    $headers .= "BCC: jaffarh701@gmail.com";

    if (mail($to, $subject, $mailcontent, $headers)) {
        echo "<script>alert('Thank you for your details. We will get back to you soon.');window.location.href='https://www.nexoradigital.co.in/';</script>";
    } else {
        echo "Email sending failed.";
    }
} else {
    echo "Error: Form not submitted properly.";
}
?>
