<?php

namespace App\Service;

class MailerService
{
    private $mailer;
    private $twigEnv;

    public function __construct(\Swift_Mailer $mailer, \Twig\Environment $twigEnv)
    {
        $this->mailer = $mailer;
        $this->twigEnv = $twigEnv;
    }

    public function postMail($value)
    {
        dump($value);
        $message = (new \Swift_Message('Votre demande ' . $value->getSubject()))
            ->setFrom('infos@danseAttitude.fr')
            ->setTo($value->getEmail())
            ->setBody(
                $this->twigEnv->render(
                    'customer/_email.html.twig',
                    [
                        'value' => $value
                    ]
                ),
                'text/html'
            );
        $this->mailer->send($message);
    }
}
