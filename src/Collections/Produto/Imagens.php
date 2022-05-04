<?php


namespace Ideris\Collections\Produto;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Produto\Imagem;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Imagens extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Imagens" => Imagem::class,
    ];

    protected $attributeMap = [
        "Imagens" => Collection::class,
    ];
}