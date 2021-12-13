<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\RegistrationEmailSender;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    /**
     * @Route(path="/send-email", name="app.send_email")
     *
     */
    public function indexAction(UserRepository $userRepository, RegistrationEmailSender $emailSender): Response
    {
        $user = $userRepository->findOneBy(['id' => 1]);
        $emailSender->sendSuccessUserRegistration($user);
//        $email = (new TemplatedEmail())
//            ->to('somebody@someone.com')
//            ->subject('Тестовое письмо')
//            ->text('Ваш почтовый клиент не поддерживает html')
//            ->html('<h1>Тестовое письмо</h1>');
//        try {
//            $mailer->send($email);
//        } catch (TransportExceptionInterface $e) {
//            return new Response('НЕ удалось отправить письмо');
//        }
        return new Response('Письмо отправлено');
    }
}