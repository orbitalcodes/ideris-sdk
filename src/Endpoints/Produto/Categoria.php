<?php

namespace Ideris\Endpoints\Produto;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Produto\Categorias;
use \Ideris\Models\Produto\Categoria as CategoriaModel;

class Categoria extends EndpointBase
{
    /**
     * Busca lista de departamentos ou busca departamento pela descrição
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#df3f2f5f-e281-4bf6-b0ae-1aaa4e50a7cc
     *
     * @param string|null $descricao
     * @param int $offset
     * @param int $limit
     * @return Categorias
     */
    public function get(string $descricao = null, int $offset = 0, int $limit = 50): Categorias
    {
        $response = $this->request('GET', 'Categoria', [
            'query' => [
                'offset'    => $offset,
                'limit'     => $limit,
                'descricao' => $descricao
            ]
        ])->getResponse();

        return new Categorias($response);
    }

    /**
     * Busca categoria por ID
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#e1ac5aa5-ad1b-4dd2-9655-1b50832c2b7b
     *
     * @param $id
     * @return CategoriaModel
     */
    public function getById($id): CategoriaModel
    {
        $response = $this->request('GET', 'Categoria/' . $id)->getResponse();
        return new CategoriaModel($response->result[0]);
    }

    /**
     * Ação responsável por cadastrar a categoria.
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#640d9272-b1bb-408c-bf06-01583f019bb1
     *
     * @param CategoriaModel $model
     * @return CategoriaModel
     */
    public function create(CategoriaModel $model): CategoriaModel
    {
        $response = $this->request('POST', 'Categoria', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body'    => $model->toJson()
        ])->getResponse();

        return new CategoriaModel($response->result[0]);
    }
}