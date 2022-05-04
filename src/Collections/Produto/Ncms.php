<?php


namespace Ideris\Collections\Produto;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Produto\Ncm;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Ncms extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Ncms" => Ncm::class,
    ];

    protected $attributeMap = [
        "Ncms" => Collection::class,
    ];
}