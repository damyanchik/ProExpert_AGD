<?php

declare(strict_types=1);

namespace App\Src\Controller;

use App\Src\Helper\Request;
use App\Src\Router;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once 'src/libraries/PHPMailer/src/PHPMailer.php';
require_once 'src/libraries/PHPMailer/src/SMTP.php';
require_once 'src/libraries/PHPMailer/src/Exception.php';

class ContactController extends AbstractController
{
    protected string $uri = '/contact';

    protected function render(): void
    {
        if (Request::isPost('submit'))
            $this->sendEmail($this->message());

        Router::route($this->uri, 'contact');
    }

    protected function sendEmail(array $data): void
    {
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPDebug = 0;
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->IsHTML(true);
        $mail->Username = 'damiann.cstore@gmail.com';
        $mail->Password = 'gtdltdkuwmowunvd';
        $mail->AddAddress('damiann.cstore@gmail.com');
        $mail->setFrom($data['email'], $data['email']);
        $mail->Subject = 'Zgłoszenie klient: '.$data['name'];
        $mail->Body = 'Numer tel: '.$data['tel'].
            '<br/>Email: '.$data['email'].
            '<br/>Treść zgłoszenia: '.$data['message'];
        $mail->Send();
    }

    protected function message(): array
    {
        $data['name'] = htmlspecialchars(Request::post('name'));
        $data['email'] = htmlspecialchars(Request::post('email'));
        $data['tel'] = intval(Request::post('tel'));
        $data['message'] = htmlspecialchars(Request::post('message'));

        return $data;
    }
}