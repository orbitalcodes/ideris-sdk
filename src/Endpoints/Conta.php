<?php

namespace Ideris\Endpoints;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Contas;

class Conta extends EndpointBase
{
    /**
     * Busca da conta do marketplace de um pedido junto ao Ideris
     *
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#95791755-ecba-40e3-add9-0f7cd2203bf3
     *
     * @param array|string $ids
     * @return Contas
     */
    public function getByIds($ids): Contas
    {
        $ids = is_array($ids) ? $ids : [$ids];

        $response = $this->request('GET', 'Conta', [
            'query' => [
                'ids' => implode(',', $ids),
            ]
        ])->getResponse();

        return new Contas($response);
    }
}