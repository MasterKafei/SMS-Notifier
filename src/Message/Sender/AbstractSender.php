<?php

namespace App\Message\Sender;

use App\Message\API\Api;
use Symfony\Contracts\Service\Attribute\Required;
use Twig\Environment;

abstract class AbstractSender
{
    private Api $api;

    private Environment $environment;

    #[Required]
    public function setMessageApi(Api $api): self
    {
        $this->api = $api;
        return $this;
    }

    #[Required]
    public function setEnvironment(Environment $environment): self
    {
        $this->environment = $environment;
        return $this;
    }

    public function send(string $phoneNumber, string $template, array $context): void
    {
        $message = $this->environment->render($template, $context);
        $this->api->send($phoneNumber, $message);
    }
}
