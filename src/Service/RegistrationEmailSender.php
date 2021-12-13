<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class RegistrationEmailSender
{

    private const SUBJECT_TITLE = 'Регистрация успешно завершена';
    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function sendSuccessUserRegistration(User $user): void
    {
        $email = $this->prepareEmail($user);

        $this->mailer->send($email);
    }

    protected function prepareEmail(User $user): TemplatedEmail
    {
        return (new TemplatedEmail())
            ->addTo(new Address($user->getEmail(), $user->getFullName()))
            ->subject(self::SUBJECT_TITLE)
            ->htmlTemplate('email/success-registration.html.twig')
            ->context([
                'name' => $user->getFullName(),
                'login' => $user->getEmail(),
            ]);
    }
}