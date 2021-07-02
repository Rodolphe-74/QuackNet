<?php


namespace App\Service;


use App\Entity\Duck;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailSender
{

    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer=$mailer;
    }

    public function welcome(Duck $duck)
    {
        $email = (new Email())
            ->from('rodolphe.gacougnolle@le-campus-numerique.fr')
            ->to($duck->getEmail())
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Confirmation d\'inscription ! ')
            ->text('Sending emails is fun again!');

        $this->mailer->send($email);
    }
}