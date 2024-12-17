<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Email details
    $to = "jaymark.catubig15@gmail.com";
    $headers = "From: " . $email . "\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Construct email content
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

    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "<p>Thank you for contacting me! I will get back to you as soon as possible.</p>";
    } else {
        echo "<p>Sorry, there was an error sending your message. Please try again later.</p>";
    }
}
?>
