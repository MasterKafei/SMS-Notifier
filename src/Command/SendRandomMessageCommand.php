<?php

namespace App\Command;

use App\Message\API\PushBulletApi;
use App\Message\Sender\AbstractSender;
use App\Message\Sender\RandomMessageSender;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Contracts\Service\Attribute\Required;

#[AsCommand(name: 'app:test')]
class SendRandomMessageCommand extends Command
{
    private RandomMessageSender $sender;

    #[Required]
    public function setSender(RandomMessageSender $abstractSender): self
    {
        $this->sender = $abstractSender;
        return $this;
    }

    public function configure(): void
    {
        $this->addArgument('phone-number', InputArgument::REQUIRED, 'Phone number');
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->sender->sendRandomMessage($input->getArgument('phone-number'));

        return Command::SUCCESS;
    }
}
