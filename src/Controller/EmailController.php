<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    /**
     * @Route(path="/send-email", name="app.send_email")
     *
     */
    public function indexAction(MailerInterface $mailer, Request $request): Response
    {
        $email = (new Email())
            ->to('somebody@someone.com')
            ->subject('Тестовое письмо')
            ->text('Ваш почтовы клиент не поддерживает html')
            ->html('<h1>Тестовое письмо</h1>');
        try {
            $mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            return new Response('НЕ удалось отправить письмо');
        }
        return new Response('Письмо отправлено');
    }
}