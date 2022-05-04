<?php

namespace Ideris\Endpoints\Produto;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Produto\Produtos;
use \Ideris\Models\Produto\Produto as ProdutoModel;
use \Ideris\Models\Produto\ProdutoRetornado;
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

    /**
     * Ação responsável por atualizar o produto
     * Se for informado id e sku na mesma chamada, a prioridade sempre será do id.
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#11d2de5d-0075-4afe-b474-9507c9767065
     *
     * @param ProdutoModel $model
     * @return ProdutoRetornado
     */
    public function update(ProdutoModel $model): ProdutoRetornado
    {
        $response = $this->request('PUT', 'Produto', [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'body'    => $model->toJson()
        ])->getResponse();

        return new ProdutoRetornado($response->result[0]);
    }

    /**
     * Ação GET responsável por buscar o produto através do ID
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#820a4161-4dc2-4708-8aa4-c1ee1d38fded
     *
     * @param int $id
     * @param bool $includeImagens Para incluir as imagens do produto na pesquisa, basta informar o parâmetro
     * @return ProdutoRetornado
     */
    public function getById(int $id, bool $includeImagens = false): ProdutoRetornado
    {
        $options = [];

        if ($includeImagens) {
            $options['query'] = ['include' => 'imagem'];
        }

        $response = $this->request('GET', 'Produto/' . $id, $options)->getResponse();
        return new ProdutoRetornado($response->result[0]);
    }

    /**
     * Ação GET responsável por trazer a lista de produtos ativos ou buscar o produto através do código SKU.
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#7b2f59bb-4170-4865-9650-0270098c39b0
     *
     * @param string|null $sku
     * @param bool $includeImagens
     * @param int $offset
     * @param int $limit
     * @return Produtos
     */
    public function get(string $sku = null, bool $includeImagens = false, int $offset = 0, int $limit = 50): Produtos
    {
        $options = [
            'query' => [
                'offset' => $offset,
                'limit'  => $limit
            ]
        ];

        if ($sku)
            $options['query']['sku'] = $sku;

        if ($includeImagens)
            $options['query']['include'] = 'imagem';

        $response = $this->request('GET', 'Produto', $options)->getResponse();

        return new Produtos($response);
    }
}