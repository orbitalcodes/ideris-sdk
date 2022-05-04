<?php

namespace Ideris\Endpoints\Produto;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Produto\Marcas;
use \Ideris\Models\Produto\Marca as MarcaModel;

class Marca extends EndpointBase
{
    /**
     * Busca lista de marcas ou busca marca pela descrição
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#5bf9fed6-e88f-4e64-8566-f439fbd6924d
     *
     * @param string|null $descricao
     * @param int $offset
     * @param int $limit
     * @return Marcas
     */
    public function get(string $descricao = null, int $offset = 0, int $limit = 50): Marcas
    {
        $response = $this->request('GET', 'Marca', [
            'query' => [
                'offset'    => $offset,
                'limit'     => $limit,
                'descricao' => $descricao
            ]
        ])->getResponse();

        return new Marcas($response);
    }

    /**
     * Busca marca por ID
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#1e3aea2a-47b0-4f15-9472-fcec49bbcb78
     *
     * @param $id
     * @return MarcaModel
     */
    public function getById($id): MarcaModel
    {
        $response = $this->request('GET', 'Marca/' . $id)->getResponse();
        return new MarcaModel($response->result[0]);
    }

    /**
     * Ação responsável por cadastrar a marca.
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#fd8a361b-a484-4209-b179-2ba015426837
     *
     * @param MarcaModel $marcaModel
     * @return MarcaModel
     */
    public function create(MarcaModel $marcaModel): MarcaModel
    {
        $response = $this->request('POST', 'Marca', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body'    => $marcaModel->toJson()
        ])->getResponse();

        return new MarcaModel($response->result[0]);
    }
}