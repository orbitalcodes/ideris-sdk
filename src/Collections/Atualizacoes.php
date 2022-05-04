<?php


namespace Ideris\Collections;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Atualizacao;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Atualizacoes extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Atualizacoes" => Atualizacao::class,
    ];

    protected $attributeMap = [
        "Atualizacoes" => Collection::class,
    ];
}