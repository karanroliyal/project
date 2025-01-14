<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST)){


    $to = $_POST['recipient_email'];
    $recipent_name = $_POST['recipient_name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $pdfFilePath = $_POST['pdf_file_path'];
    // $headers = "From: webmaster@example.com" . "\r\n" .
    // "CC: somebodyelse@example.com";
    
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    
    //Load Composer's autoloader
    require '../../vendor/autoload.php';
    
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'karanroliyal12@gmail.com';                     //SMTP username
        $mail->Password   = 'pzxs awnw pbgi szno';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        // $mail->setFrom('from@example.com', 'Mailer');
        $mail->addAddress($to, $recipent_name);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
    
        //Attachments
        // $mail->addAttachment('../../var/tmp/file.tar.gz');         //Add attachments
        // if (!empty($pdfFilePath) && file_exists($pdfFilePath)) {
            $mail->addAttachment("../../".$pdfFilePath); 
            // echo  $pdfFilePath ;// Attach PDF file
        // }
        // if(!empty($_FILES['file']['name'])){
        //     for($i = 0 ; $i < count($_FILES['file']) ; $i++ ){
        //         $mail->addAttachment($_FILES['file']['tmp_name'][$i], $_FILES['file']['name'][$i]);    //Optional name
        //         print_r($_FILES['file']['tmp_name']);
        //         print_r($_FILES['file']['name']);
        //     }
        // }
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $message;
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        echo "success";
    } catch (Exception $e) {
        echo "Message could not be sent: {$mail->ErrorInfo}";
    }

}


?>