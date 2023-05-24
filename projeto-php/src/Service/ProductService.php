<?php

namespace App\Service;

use App\Entity\Product;

class ProductService
{
    /**
     * @param array $data
     * @return Product
     */
    public function createProduct(array $data): Product
    {
        $product = new Product();
        $product->setTitle($data['title']);
        $product->setPrice($data['price']);
        $product->setDescription($data['description']);
        $product->setCategory($data['category']); // arrumar o nome para category
        $product->setImage($data['image']); // ajustar para salvar imagem

        return $product;
    }
}