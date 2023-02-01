<?php

namespace App\Controller;
 use App\Service\ParseService;
 use Doctrine\DBAL\Driver\PDOException;
 use PDO;
 use Symfony\Component\Routing\Annotation\Route;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 class LuckyController extends AbstractController
{
     /**
      * @var ParseService|null
      */
     private $parseService;

     public function __construct(
        ParseService $parseService = null
    )
    {
        $this->parseService = $parseService;
    }

     #[Route('/q')]
    public function number(): Response
    {

        $servername = "127.0.0.1:3306";
        $database = "myproj";
        $username = "root";
        $password = "secret";
// Создаем соединение
         try {
             $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
             echo "Connected to $database at $servername successfully.";
         } catch (PDOException $pe) {
             die("Could not connect to the database $database :" . $pe->getMessage());
         }

         dd();
         $html = $this->parseService->curl1lvl('http://bibliya-online.ru/poslanie-k-evreyam-glava-9/');
        //$number = random_int(0, 100);

        return $this->render('lucky/number.html.twig', [
            'number' => $html,
        ]);
    }
}