<?php

/**
 * Description of Email
 *
 * @author JOSE-PAULO - Cofunder Hox.com.br
 */

namespace Source\Support;

use Exception;
use stdClass;
use PHPMailer\PHPMailer\PHPMailer;

class Email
{
    /** @var PHPMailer */
    private $mail;
    /** @var stdClass */
    private $data;
    /** @var Exception */
    private $error;

    public function __construct()
    {
        $this->mail = new PHPMailer("true");
       // $this->mail->SMTPDebug = "2";

        $this->data = new stdClass();

        $this->mail->isSMTP();
        $this->mail->isHTML();
        $this->mail->setLanguage("br");

        $this->mail->SMTPAuth = true;
        $this->mail->SMTPSecure = "tls";
        $this->mail->CharSet = "utf-8";

        $this->mail->Host = MAIL_HOST;
        $this->mail->Port = MAIL_PORT;
        $this->mail->Username = MAIL_USER;
        $this->mail->Password = MAIL_PASS;
    }

    public function add(string $assunto, string $corpo, string $nome_recipiente, string $email_recipiente): Email
    {
        $this->data->subject = $assunto;
        $this->data->body = $corpo;
        $this->data->recipient_name = $nome_recipiente;
        $this->data->recipient_email = $email_recipiente;
        return $this;
    }

    public function attach(string $filePath, string $fileName): Email
    {
        $this->data->attach[$filePath] = $fileName;
        return  $this;
    }


    public function send(string $from_name = MAIL_FROMNAME, string $from_email = MAIL_FROMEMAIL): bool
    {
        try {
            $this->mail->Subject = $this->data->subject;
            $this->mail->msgHTML($this->data->body);
            $this->mail->addAddress($this->data->recipient_email, $this->data->recipient_name);
            $this->mail->setFrom($from_email, $from_name);

            if(!empty($this->data->attach))
            {
                foreach ($this->data->attach as $path => $name){
                    $this->mail->addAttachment($path, $name);
                }
            }
            $this->mail->send();
            return true;
        } catch (Exception $exception) {
            $this->error = $exception;
            return false;
        }
    }

    public function error(): ? Exception
    {
        return $this->error;
    }

}
