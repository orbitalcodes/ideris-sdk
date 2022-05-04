<?php

namespace Ideris\Endpoints\Produto;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Produto\Origens;

class Origem extends EndpointBase
{
    /**
     * Ação GET responsável por trazer a lista de origem do produto ativos.
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#89ee5855-06b6-4483-b1ba-a82e43d12948
     *
     * @param int $offset
     * @param int $limit
     * @return Origens
     */
    public function get(int $offset = 0, int $limit = 50): Origens
    {
        $response = $this->request('GET', 'ProdutoOrigem', [
            'query' => [
                'offset'    => $offset,
                'limit'     => $limit,
            ]
        ])->getResponse();

        return new Origens($response);
    }
}