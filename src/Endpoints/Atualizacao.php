<?php

namespace Ideris\Endpoints;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Atualizacoes;

class Atualizacao extends EndpointBase
{
    /**
     * Ação GET responsável por trazer a lista de atualizações realizadas na API pública do Ideris.
     *
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#b0f62d47-83fe-4220-80ef-8a628d1a9583
     *
     * @return Atualizacoes
     */
    public function get(int $offset = 0, int $limit = 50): Atualizacoes
    {
        $response = $this->request('GET', 'Atualizacao', [
            'query' => [
                'offset' => $offset,
                'limit'  => $limit
            ]
        ])->getResponse();

        return new Atualizacoes($response);
    }
}