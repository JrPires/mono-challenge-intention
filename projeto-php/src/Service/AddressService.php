<?php

namespace App\Service;

use App\Entity\Address;

class AddressService
{
    /**
     * @param array $addressData
     * @return Address
     */
    public function createAddress(array $addressData): Address
    {
        $address = new Address();
        $address->setAddress($addressData['address']['address']);
        $address->setNumber($addressData['address']['number']);
        $address->setCity($addressData['address']['city']);
        $address->setState($addressData['address']['state']);
        $address->setCountry($addressData['address']['country']);

        return $address;
    }
}