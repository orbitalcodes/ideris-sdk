<?php

namespace Ideris\Endpoints;

use Ideris\Classes\EndpointBase;
use Ideris\Collections\Status as StatusCollection;

class Status extends EndpointBase
{
    /**
     * Pasta onde fica as ações de status junto ao Ideris.
     *
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#3c9c92c7-165f-4d19-985a-1065b03db35d
     *
     * @return StatusCollection
     */
    public function get(int $offset = 0, int $limit = 50): StatusCollection
    {
        $response = $this->request('GET', 'Status', [
            'query' => [
                'offset' => $offset,
                'limit'  => $limit
            ]
        ])->getResponse();

        return new StatusCollection($response);
    }
}