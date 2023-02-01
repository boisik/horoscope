<?php
namespace App\Service;
use App\Entity\ImportListItem;
use App\Repository\ImportListItemRepository;
use Doctrine\ORM\EntityManager;
use PhpQuery\PhpQuery;
class ParseService
{

    /**
     * @var ImportListItemRepository|null
     */
    private $importListItemRepository;
    /**
     * @var EntityManager|null
     */
    private $entityManager;

    /**
     * ParseService constructor.
     * @param ImportListItemRepository|null $importListItemRepository
     */
    public function __construct(
        ImportListItemRepository $importListItemRepository = null,
        EntityManager $entityManager = null
    )
    {
        $this->importListItemRepository = $importListItemRepository;
        $this->entityManager = $entityManager;
    }

    function curl1lvl($url)
    {
        $pq = $this->curl($url);

        $data1 = array();

        $listLinks1 = $pq->query('.menu li a');
        foreach ($listLinks1 as $link){
            $data1[] = $link->getAttribute('href');
        }

        foreach($data1 as $data1url){
            $pq1 = $this->curl($data1url);
            $listLinks2 = $pq1->query('td a');
            foreach ($listLinks2 as $link){
                $url = $link->getAttribute('href');
                $this->createImportListItem($url);
            }
            sleep(1);
        }

    }

    function createImportListItem($url)
    {
        $importListItem = $this->importListItemRepository->findOneBy(
            [
                'url' => $url
            ]
        );
        if ($importListItem){
            echo 'такой уже есть';
            return;
        }
        $importListItem = new importListItem();
        $importListItem->setUrl($url);
        $this->importListItemRepository->add($importListItem,true);


    }


    function curl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        //return $html;

        $pq = new PhpQuery;
        $pq->load_str($result);
        return $pq;


    }
}