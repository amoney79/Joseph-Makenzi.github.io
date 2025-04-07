<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Replace with your real receiving email address
$receiving_email_address = 'mackenziejoseph396@gmail.com';

// Check if the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Sanitize and validate inputs
  $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
  $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

  // Check for missing or invalid inputs
  if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    die('All fields are required.');
  }
  if (!$email) {
    die('Invalid email address.');
  }

  // Email headers
  $headers = "From: $name <$email>\r\n";
  $headers .= "Reply-To: $email\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

  // Send the email
  $mail_sent = mail($receiving_email_address, $subject, $message, $headers);

  if ($mail_sent) {
    echo 'Email sent successfully!';
  } else {
    die('Failed to send email. Please try again later.');
  }
} else {
  die('Invalid request method.');
}
?>
