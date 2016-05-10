<?php

namespace AppBundle\Service\Schedule\Api;

use AppBundle\Service\Api\Client;

class Schedule
{
    protected $apiClient;

    public function __construct(Client $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * @param int $season YYYY format
     * @return array
     */
    public function get($season)
    {
        return $this->apiClient->request(
            'GET',
            Client::API_URL . sprintf('Games/%s', $season)
        );
    }
}
