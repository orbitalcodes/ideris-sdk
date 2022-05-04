<?php


namespace Ideris\Collections;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Protocolo;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Protocolos extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Protocolos" => Protocolo::class,
    ];

    protected $attributeMap = [
        "Protocolos" => Collection::class,
    ];
}