<?php

namespace App\Repository;

use App\Entity\Address;
use App\Entity\Client;
use App\Entity\IntencaoCompra;
use App\Entity\Product;
use App\Entity\Rating;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<IntencaoCompra>
 *
 * @method IntencaoCompra|null find($id, $lockMode = null, $lockVersion = null)
 * @method IntencaoCompra|null findOneBy(array $criteria, array $orderBy = null)
 * @method IntencaoCompra[]    findAll()
 * @method IntencaoCompra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntencaoCompraRepository extends ServiceEntityRepository
{
    private ClientRepository $clientRepository;
    private ProductRepository $productRepository;
    private RatingRepository $ratingRepository;
    private IntencaoCompraRepository $intencaoCompraRepository;

    public function __construct(
        ManagerRegistry $registry,
        ClientRepository $clientRepository,
        ProductRepository $productRepository,
        RatingRepository $ratingRepository,
        IntencaoCompraRepository $intencaoCompraRepository
    )
    {
        parent::__construct($registry, IntencaoCompra::class);
        $this->clientRepository = $clientRepository;
        $this->productRepository = $productRepository;
        $this->ratingRepository = $ratingRepository;
        $this->intencaoCompraRepository = $intencaoCompraRepository;
    }

    public function save(IntencaoCompra $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(IntencaoCompra $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @return array
     */
    public function findByIntencaoCompra(): array
    {
        return $this->createQueryBuilder('ic')
            ->leftJoin('ic.product_id', 'p')
            ->leftJoin('ic.client_id', 'c')
            ->leftJoin('c.address_id', 'a')
            ->leftJoin('p.rating_id', 'r')
            ->addSelect('p')
            ->addSelect('c')
            ->addSelect('a')
            ->addSelect('r')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param Address $address
     * @param Product $product
     * @param Client $client
     * @param Rating $rating
     * @param IntencaoCompra $compra
     */
    public function createIntencaoCompra(
        Address $address,
        Product $product,
        Client $client,
        Rating $rating,
        IntencaoCompra $compra
    ): void
    {
        $this->clientRepository->save($client, true);
        $this->productRepository->save($product, true);
        $this->ratingRepository->save($rating, true);
        $this->intencaoCompraRepository->save($compra, true);
    }

//    public function findOneBySomeField($value): ?IntencaoCompra
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
