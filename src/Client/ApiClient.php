<?php

namespace Ideris\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class ApiClient extends Client
{
    public function request(string $method, $uri = '', array $options = []): ResponseInterface
    {
        try {
            return parent::request($method, $uri, $options);
        } catch (ClientException $e) {
            throw new ApiException(
                $e->getMessage(),
                $e->getCode(),
                $e->getResponse()
            );
        }
    }
}