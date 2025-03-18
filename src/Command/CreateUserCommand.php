<?php

namespace App\Command;

use Exception;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\AppUser as User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

#[AsCommand(
    name: 'Create-User',
    description: 'Add a short description for your command',
)]
class CreateUserCommand extends Command
{
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'nom de l\'utiliateur')
            ->addArgument('email', InputArgument::REQUIRED, 'Email de l\'utilisateur')
            ->addArgument('password', InputArgument::REQUIRED, 'Mot de passe')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        
        $arg1 = $input->getArgument('name');
        $arg2 = $input->getArgument('email');
        $arg3 = $input->getArgument('password');

        if (($arg1 || $arg2 || $arg3) == null) {
           throw new Exception("Please provide all arguments", 1);
        } else 

        $user = new User();
        $user->setName($arg1);
        $user->setEmail($arg2);
        $user->setPassword(password_hash($arg3, PASSWORD_DEFAULT));

        $this->em->persist($user);
        $this->em->flush();        
        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
