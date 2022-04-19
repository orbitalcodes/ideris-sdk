<?php

namespace Ideris\Traits;

trait Paginable
{
    /**
     * Nó responsável por auxiliar a paginação
     *
     * @return \StdClass
     */
    public function getPaging(): \StdClass
    {
        return $this->response->paging ?? new \StdClass();
    }

    /**
     * Registro de início para busca no banco de dados
     *
     * @return int
     */
    public function getOffset(): int
    {
        return $this->response->paging->offset;
    }

    /**
     * Número total de registros
     *
     * @return int
     */
    public function getTotal(): int
    {
        return $this->response->paging->total;
    }

    /**
     * Limite de registros retornados. O limite máximo é 50
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->response->paging->limit;
    }

    /**
     * Número de registros retornados
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->response->paging->count;
    }
}