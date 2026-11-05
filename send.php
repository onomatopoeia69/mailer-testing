
<?php

header('Content-Type: application/json');

require __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function respond($success, $message, $status = 200) {
    http_response_code($status);

    echo json_encode([
        'success' => $success,
        'message' => $message
    ]);

    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    respond(false, 'Invalid request.', 405);
}

$email = filter_var($_POST['email'] ?? '', FILTER_VALIDATE_EMAIL);
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

$gmail_username = trim($_POST['gmail_username'] ?? '');
$mail_password = trim($_POST['mail_password'] ?? '');
$display_name = trim($_POST['display_name'] ?? '');

if (
    !$email || !$subject || !$message ||
    !filter_var($gmail_username, FILTER_VALIDATE_EMAIL) ||
    !$mail_password || !$display_name
) {
    respond(false, 'Please provide valid email details.', 400);
}

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = $gmail_username;
    $mail->Password = $mail_password;

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom($gmail_username, $display_name);
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = nl2br(htmlspecialchars($message));

    $mail->AltBody = $message;

    $mail->send();

    respond(true, 'Email successfully sent to ' . $email);

} catch (Exception $e) {

    $error = $mail->ErrorInfo;

    error_log("PHPMailer Error: " . $error);

    if (stripos($error, 'authenticate') !== false ||
        stripos($error, 'username and password') !== false ||
        stripos($error, 'credentials') !== false) {

        $message = 'Gmail authentication failed. Check your Gmail username and App Password.';

    } elseif (stripos($error, 'Could not connect') !== false ||
              stripos($error, 'Connection timed out') !== false) {

        $message = 'Unable to connect to Gmail SMTP. Check your internet connection or SMTP configuration.';

    } elseif (stripos($error, 'Invalid address') !== false) {

        $message = 'The recipient email address is invalid.';

    } elseif (stripos($error, 'data not accepted') !== false) {

        $message = 'Gmail rejected the email. Check your message content and sending restrictions.';

    } else {

        $message = 'Email sending failed: ' . $error;

    }

    respond(false, $message, 500);
}
