<?php

namespace App\Message\Sender;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Yaml\Yaml;

class RandomMessageSender extends AbstractSender
{
    private array $randomMessages;

    public function __construct(KernelInterface $kernel)
    {
        $this->randomMessages = Yaml::parseFile($kernel->getProjectDir() . '/config/messages/random_messages.yaml')['messages'];
    }

    public function sendRandomMessage(string $phoneNumber, array $randomMessages = null): void
    {
        if (null === $randomMessages) {
            $randomMessages = $this->randomMessages;
        }

        $this->send($phoneNumber, 'random_messages.html.twig', [
            'message' => $randomMessages[rand(0, count($randomMessages) - 1)],
        ]);
    }
}
