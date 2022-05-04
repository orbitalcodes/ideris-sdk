<?php

namespace Ideris\Endpoints\Produto;

use Ideris\Classes\EndpointBase;
use \Ideris\Models\Produto\Produto as ProdutoModel;
use Ideris\Models\Protocolo;

class Produto extends EndpointBase
{
    /**
     * Ação responsável por cadastrar o produto.
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#97f77b1c-bed6-445a-88bc-cc994c38d4a8
     *
     * @param ProdutoModel $model
     * @return Protocolo
     */
    public function create(ProdutoModel $model): Protocolo
    {
        $response = $this->request('POST', 'Produto', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body'    => $model->toJson()
        ])->getResponse();

        return new Protocolo($response->result[0]);
    }
}