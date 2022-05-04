<?php


namespace Ideris\Collections;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Conta;
use Illuminate\Support\Collection;

class Contas extends CollectionBase
{
    protected $itemAttributeModel = [
        "Contas" => Conta::class,
    ];

    protected $attributeMap = [
        "Contas" => Collection::class,
    ];
}