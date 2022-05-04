<?php


namespace Ideris\Collections;

use Ideris\Classes\CollectionBase;
use Ideris\Models\Status as StatusModel;
use Ideris\Traits\Paginable;
use Illuminate\Support\Collection;

class Status extends CollectionBase
{
    use Paginable;

    protected $itemAttributeModel = [
        "Status" => StatusModel::class,
    ];

    protected $attributeMap = [
        "Status" => Collection::class,
    ];
}