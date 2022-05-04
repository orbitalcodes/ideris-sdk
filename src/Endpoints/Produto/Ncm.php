<?php

namespace Ideris\Endpoints\Produto;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Produto\Ncms;
use \Ideris\Models\Produto\Ncm as NcmModel;

class Ncm extends EndpointBase
{
    /**
     * Busca lista de ncm
     *
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#36274aab-ccb9-4f19-bd5e-dec45700ff50
     *
     * @return Ncms
     */
    public function get(int $offset = 0, int $limit = 50): Ncms
    {
        $response = $this->request('GET', 'Ncm', [
            'query' => [
                'offset' => $offset,
                'limit'  => $limit
            ]
        ])->getResponse();

        return new Ncms($response);
    }

    /**
     * Busca lista de ncm por código
     *
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#36274aab-ccb9-4f19-bd5e-dec45700ff50
     *
     * @return NcmModel
     */
    public function getByCode($code): NcmModel
    {
        $response = $this->request('GET', 'Ncm', [
            'query' => [
                'codigo' => $code,
            ]
        ])->getResponse();

        return new NcmModel($response->result[0]);
    }

    /**
     * Ação responsável por cadastrar o Ncm
     *
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#5244801e-38ab-4873-966e-a7640d805ee4
     *
     * @param NcmModel $ncmModel
     * @return NcmModel
     */
    public function create(NcmModel $ncmModel): NcmModel
    {
        $response = $this->request('POST', 'Ncm', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body'    => $ncmModel->toJson()
        ])->getResponse();

        return new NcmModel($response->result[0]);
    }
}