<?php

namespace Ideris\Endpoints\Produto;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Produto\Departamentos;
use \Ideris\Models\Produto\Departamento as DepartamentoModel;

class Departamento extends EndpointBase
{
    /**
     * Busca lista de departamentos ou busca departamento pela descrição
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#df3f2f5f-e281-4bf6-b0ae-1aaa4e50a7cc
     *
     * @param string|null $descricao
     * @param int $offset
     * @param int $limit
     * @return Departamentos
     */
    public function get(string $descricao = null, int $offset = 0, int $limit = 50): Departamentos
    {
        $response = $this->request('GET', 'Departamento', [
            'query' => [
                'offset'    => $offset,
                'limit'     => $limit,
                'descricao' => $descricao
            ]
        ])->getResponse();

        return new Departamentos($response);
    }

    /**
     * Busca departamento por ID
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#593f8264-a47b-42f9-9aff-a2a49f172886
     *
     * @param $id
     * @return DepartamentoModel
     */
    public function getById($id): DepartamentoModel
    {
        $response = $this->request('GET', 'Departamento/' . $id)->getResponse();
        return new DepartamentoModel($response->result[0]);
    }

    /**
     * Ação responsável por cadastrar o departamento.
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#198307ca-c9f8-403a-b11a-cb1cd0cb9dc3
     *
     * @param DepartamentoModel $marcaModel
     * @return DepartamentoModel
     */
    public function create(DepartamentoModel $marcaModel): DepartamentoModel
    {
        $response = $this->request('POST', 'Departamento', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body'    => $marcaModel->toJson()
        ])->getResponse();

        return new DepartamentoModel($response->result[0]);
    }
}