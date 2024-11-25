<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Email configuration
	$to = 'mail@quotalogic.io';
	$subject = 'Email from quotalogic.io';
	$message = '';
	
	// Add POST data to email message
    foreach ($_POST as $key => $value) {
        $message .= $key . ': ' . $value . PHP_EOL;
    }
	
	// Send the email
	if(mail($to, $subject, $message)) {
		$response = array('status' => 'success', 'message' => 'Email sent successfully!');
	} else {
	    http_response_code(500);
	    $response = array('status' => 'error', 'message' => 'Error sending email: ' . $mail->ErrorInfo);
	}
} else {
    http_response_code(405);
    $response = array('status' => 'error', 'message' => 'Method not allowed');
}

echo json_encode($response);
?>