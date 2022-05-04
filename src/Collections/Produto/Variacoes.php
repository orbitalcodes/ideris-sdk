<?php


namespace Ideris\Collections\Produto;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Produto\Variacao;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Variacoes extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Variacoes" => Variacao::class,
    ];

    protected $attributeMap = [
        "Variacoes" => Collection::class,
    ];
}