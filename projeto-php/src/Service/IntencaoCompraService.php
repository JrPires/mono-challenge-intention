<?php

namespace App\Service;

use App\Entity\Client;
use App\Entity\IntencaoCompra;
use App\Entity\Product;
use App\Repository\IntencaoCompraRepository;

class IntencaoCompraService
{
    private AddressService $addressService;
    private ClientService $clientService;
    private ProductService $productService;
    private RatingService $ratingService;
    private IntencaoCompraRepository $intencaoCompraRepository;

    public function __construct(
        AddressService $addressService,
        ClientService $clientService,
        ProductService $productService,
        RatingService $ratingService,
        IntencaoCompraRepository $intencaoCompraRepository
    )
    {
        $this->addressService = $addressService;
        $this->clientService = $clientService;
        $this->productService = $productService;
        $this->ratingService = $ratingService;
        $this->intencaoCompraRepository = $intencaoCompraRepository;
    }

    /**
     * @param array $data
     * @param Client $client
     * @param Product $product
     * @return IntencaoCompra
     * @throws \Exception
     */
    public function createIntencaoCompra(array $data, Client $client, Product $product): IntencaoCompra
    {
        $compra = new IntencaoCompra();
        $compra->setClientId($client);
        $compra->setProductId($product);
        $compra->setCreatedAt(new \DateTimeImmutable('now', new \DateTimeZone('America/Sao_Paulo')));

        return $compra;
    }


    public function intencaoCompraService($data)
    {
        $address = $this->addressService->createAddress($data);
        $product = $this->productService->createProduct($data);
        $client = $this->clientService->createClient($data, $address);
        $rating = $this->ratingService->createRating($data, $product);
        $compra = $this->createIntencaoCompra($data, $client, $product);

        $this->intencaoCompraRepository
            ->createIntencaoCompra($address, $product, $client, $rating, $compra);
    }
}