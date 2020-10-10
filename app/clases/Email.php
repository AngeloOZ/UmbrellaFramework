<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require PHPMAILER.'Exception.php';
require PHPMAILER.'PHPMailer.php';
require PHPMAILER.'SMTP.php';
class Email{

    private $to;
    private $toName;
    private $subject;
    private $message;

    function __construct($to, $subject, $message)
    {
        if(is_array($to)){
            $this->to = $to['email'];
            $this->toName = $to['name'];
        }else{
            $this->to = $to;
        }
        $this->subject = $subject;
        $this->message = $message;
    }

    public static function sendMail($to, $subject, $message){
        $self = new self($to, $subject, $message);
        $mail = new PHPMailer(true);
        try {
        //Server Setting
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = EMAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = EMAIL_USER;
            $mail->Password   = EMAIL_PASSWORD;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = EMAIL_PORT;
            //Reciver
            $mail->setFrom(EMAIL_USER, EMAIL_SENDER);
            $mail->addAddress($self->to, $self->toName);

            // Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

            // Content
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $self->subject;
            $mail->Body    = $self->message;

            if($mail->send()){
                return 'ok';
            }
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }
    
}