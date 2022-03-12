<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        # FIX: Replace this email with recipient email
        $mail_to = "raphael.le.magnetiseur@gmail.com";
        
        # Sender Data
        $subject = trim($_POST["subject"]);
        $sphone = trim($_POST["phone"]);
        $name = str_replace(array("\r","\n"),array(" "," ") , strip_tags(trim($_POST["name"])));
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);
        
        if ( empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL) OR empty($subject) OR empty($message)) {
            # Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Veuillez remplir le formulaire et réessayer.";
            exit;
        }
        
        # Mail Content
        $content = "name: $name\n";
        $content = "subject: $subject\n";
        $content = "phone: $phone\n";
        $content .= "email: $email\n\n";
        $content .= "message:\n$message\n";

        # email headers.
        $headers = "De: $name <$email>";

        # Send the email.
        $success = mail($mail_to,$content, $headers);
        if ($success) {
            # Set a 200 (okay) response code.
            http_response_code(200);
            echo "Merci! Votre message a été envoyé.";
        } else {
            # Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Une erreur s'est produite, nous n'avons pas pu envoyer votre message.";
        }

    } else {
        # Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Il y a eu un problème avec votre soumission, veuillez réessayer.";
    }

?>
