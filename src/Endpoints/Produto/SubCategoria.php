<?php

namespace Ideris\Endpoints\Produto;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Produto\SubCategorias;
use \Ideris\Models\Produto\SubCategoria as SubCategoriaModel;

class SubCategoria extends EndpointBase
{
    /**
     * Busca lista de departamentos ou busca departamento pela descrição
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#df3f2f5f-e281-4bf6-b0ae-1aaa4e50a7cc
     *
     * @param string|null $descricao
     * @param int $offset
     * @param int $limit
     * @return SubCategorias
     */
    public function get(string $descricao = null, int $offset = 0, int $limit = 50): SubCategorias
    {
        $response = $this->request('GET', 'SubCategoria', [
            'query' => [
                'offset'    => $offset,
                'limit'     => $limit,
                'descricao' => $descricao
            ]
        ])->getResponse();

        return new SubCategorias($response);
    }

    /**
     * Busca categoria por ID
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#e1ac5aa5-ad1b-4dd2-9655-1b50832c2b7b
     *
     * @param $id
     * @return SubCategoriaModel
     */
    public function getById($id): SubCategoriaModel
    {
        $response = $this->request('GET', 'SubCategoria/' . $id)->getResponse();
        return new SubCategoriaModel($response->result[0]);
    }

    /**
     * Ação responsável por cadastrar a categoria.
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#640d9272-b1bb-408c-bf06-01583f019bb1
     *
     * @param SubCategoriaModel $model
     * @return SubCategoriaModel
     */
    public function create(SubCategoriaModel $model): SubCategoriaModel
    {
        $response = $this->request('POST', 'SubCategoria', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body'    => $model->toJson()
        ])->getResponse();

        return new SubCategoriaModel($response->result[0]);
    }
}