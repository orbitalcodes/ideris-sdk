<?php

namespace Ideris\Endpoints;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Protocolos;

class Protocolo extends EndpointBase
{
    /**
     * Busca protocolos pendentes ou busca protocolo por código
     *
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#e26e24fb-1820-4327-9caa-fb6b6caa190e
     *
     * @return Protocolos
     */
    public function get(int $offset = 0, int $limit = 50): Protocolos
    {
        $response = $this->request('GET', 'Protocolo', [
            'query' => [
                'offset' => $offset,
                'limit'  => $limit
            ]
        ])->getResponse();

        return new Protocolos($response);
    }

    /**
     * Caso a busca seja de um código específico, basta informar o mesmo na URL
     *
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#e26e24fb-1820-4327-9caa-fb6b6caa190e
     *
     * @return Protocolos
     */
    public function getByCode(string $code, int $offset = 0, int $limit = 50): Protocolos
    {
        $response = $this->request('GET', 'Protocolo', [
            'query' => [
                'offset' => $offset,
                'limit'  => $limit,
                'codigo' => $code,
            ]
        ])->getResponse();

        return new Protocolos($response);
    }

    /**
     * Caso a busca seja de um código específico, basta informar o mesmo na URL
     *
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#e26e24fb-1820-4327-9caa-fb6b6caa190e
     *
     * @return Protocolos
     */
    public function getBySku(string $sku, int $offset = 0, int $limit = 50): Protocolos
    {
        $response = $this->request('GET', 'Protocolo', [
            'query' => [
                'offset' => $offset,
                'limit'  => $limit,
                'sku'    => $sku,
            ]
        ])->getResponse();

        return new Protocolos($response);
    }
}