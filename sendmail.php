<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are filled
    if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        // Sanitize input to prevent injection attacks
        $name = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $phone = isset($_POST["phone"]) ? filter_var($_POST["phone"], FILTER_SANITIZE_STRING) : 'Not provided';
        $message = filter_var($_POST["message"], FILTER_SANITIZE_STRING);

        $to = "j.michaelduhart@gmail.com";
        $subject = "New Contact Form Submission";
        
        // Construct email body
        $body = "Name: {$name}\nEmail: {$email}\nPhone: {$phone}\nMessage: {$message}";

        // Use a predefined email in the From header and include user's email in the body
        $headers = "From: noreply@yourdomain.com";

        if (mail($to, $subject, $body, $headers)) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send message.";
        }
    } else {
        echo "Please fill in all required fields.";
    }
}
