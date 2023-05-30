<?php

namespace App\Service;

use App\Entity\Address;
use App\Entity\Client;

class ClientService
{
    /**
     * @param array $data
     * @param Address $address
     * @return Client
     */
    public function createClient(array $data, Address $address): Client
    {
        $client = new Client();
        $client->setNome($data['name']);
        $client->setAddressId($address);

        return $client;
    }
}