<?php

namespace AppBundle\Service\Api;

use GuzzleHttp\Client as RequestClient;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;

class Client
{
    const API_URL = 'https://api.fantasydata.net/mlb/v2/JSON/';

    protected $requestClient;
    protected $logger;
    protected $apiKey;

    public function __construct(RequestClient $requestClient, $apiKey, LoggerInterface $logger)
    {
        $this->requestClient = $requestClient;
        $this->apiKey = $apiKey;
        $this->logger = $logger;
    }

    public function request($method, $url, array $options = [])
    {
        try {
            $options = array_merge($options, [
                'headers' => [
                    'Ocp-Apim-Subscription-Key' => $this->apiKey
                ]
            ]);
            $request = $this->requestClient->request($method, $url, $options);
            $content = $request->getBody()->getContents();

            return json_decode($content, true);
        } catch (RequestException $e) {
            $this->logger->error('Request error', ['request' => $e->getMessage()]);
            return null;
        }
    }
}
