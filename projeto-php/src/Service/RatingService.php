<?php

namespace App\Service;

use App\Entity\Product;
use App\Entity\Rating;

class RatingService
{
    /**
     * @param array $data
     * @param Product $product
     * @return Rating
     */
    public function createRating(array $data, Product $product): Rating
    {
        $rating = new Rating();
        $rating->setRate($data['rating']['rate']);
        $rating->setCount($data['rating']['count']);
        $rating->setProductId($product);

        return $rating;
    }
}