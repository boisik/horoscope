<?php

namespace App\Command;



use App\Service\ParseService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;

use DateTime;

#[AsCommand(name: 'parse:links')]
class Parse extends Command
{

    /**
     * @var \Doctrine\DBAL\Connection
     */
    private $conn;
    /**
     * @var ParseService|null
     */
    private $parseService;


    /**
     *
     * @param string|null $name
     * @param EntityManagerInterface|null $entityManager
     */
    public function __construct(
        string $name = null,
        EntityManagerInterface $entityManager = null,
        ParseService $parseService = null
    ) {
        parent::__construct($name);
        $this->conn = $entityManager->getConnection();
        $this->parseService = $parseService;
    }

    protected function configure()
    {
        $this
            ->setDescription('Сохранить список ссылок с христианского ресурса');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->parseService->curl1lvl('http://bibliya-online.ru/poslanie-k-evreyam-glava-9/');
        return Command::SUCCESS;
    }



}