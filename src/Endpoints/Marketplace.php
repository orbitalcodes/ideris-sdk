<?php

namespace Ideris\Endpoints;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Marketplaces;

class Marketplace extends EndpointBase
{
    /**
     * Ação GET responsável por trazer a lista de marketplaces integrados ao Ideris.
     *
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#e3d76bcf-950d-486a-91be-fdf20f75a0b3
     *
     * @return Marketplaces
     */
    public function get(int $offset = 0, int $limit = 50): Marketplaces
    {
        $response = $this->request('GET', 'Marketplace', [
            'query' => [
                'offset' => $offset,
                'limit'  => $limit
            ]
        ])->getResponse();

        return new Marketplaces($response);
    }
}