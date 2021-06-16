<?php 

namespace app\config;

require __DIR__.'/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use app\config\DotEnv;

class Mail{

    private $mailer;

    public function __construct(){
        //load data from env
        ( new DotEnv(__DIR__.'/../../.env') )->load();

        //true enable Exceptions
        $this->mailer = new PHPMailer(true);
    }


    public function tryToSendMailTo($address, $message){
        try{
            $this->initServerSettings();
            $this->setRecipient($address);
            $this->setMessageBody($message);
            $this->mailer->send();
        }
        catch (\Exception $e) {
             echo \json_encode([ 'message' => "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}"]);
             die();
        }
    }


    /* Smtp server initialization */

    public function initServerSettings(){
        //$this->mailer->SMTPDebug = SMTP::DEBUG_SERVER;              //enable debug information 
        $this->mailer->isSMTP();                                      //send using SMTP
        $this->mailer->Host = getenv('SMTP_MAILTRAP');                //set SMTP server
        $this->mailer->Port = getenv('SMTP_MAILTRAP_PORT');           // Gmail SMTP port
        $this->mailer->SMTPAuth = true;                               //set SMTP authorization 
        $this->mailer->Username = getenv('SMTP_MAILTRAP_USER');       //user account from mail will be send
        $this->mailer->Password = getenv('SMTP_MAILTRAP_PASSWORD');   //user account password 
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //enable tls mail encryption
    }



    public function setRecipient($address){
        $this->mailer->setFrom( getenv('SMTP_USER'), 'JanuszexShop'); //set from who
        $this->mailer->addAddress( $address );                        //set to who 
    }


    public function setMessageBody($message){
        $this->mailer->isHTML(true);                                  //Set email format to HTML
        $this->mailer->Subject = 'Kod weryfikacyjny';                 //mail subject 
        $this->mailer->Body = "Kod: ".$message;
        $this->mailer->AltBody = "Kod".$message;
    }

    public function setBody($subject, $message){
        $this->mailer->isHTML(true);                              //Set email format to HTML
        $this->mailer->Subject = $subject;                        //mail subject 
        $this->mailer->Body = $message;
        $this->mailer->AltBody = $message;
    }


}