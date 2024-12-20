<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate the inputs
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Validate the email address
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Define the recipient email address
    $to = "jaymark.catubig15@gmail.com";  // Change this to your email address

    // Set email headers
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Construct the email body
    $email_subject = "Contact Form: " . $subject;
    $email_body = "
    <html>
    <head>
        <title>Contact Form Message</title>
    </head>
    <body>
        <h2>New Message from Contact Form</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
        <p><strong>Subject:</strong> $subject</p>
        <p><strong>Message:</strong> $message</p>
    </body>
    </html>";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // On success, show a success message
        echo "<p>Thank you for contacting me! I will get back to you as soon as possible.</p>";
    } else {
        // On failure, show an error message
        echo "<p>Sorry, there was an error sending your message. Please try again later.</p>";
    }
}
?>
