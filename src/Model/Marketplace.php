<?php


namespace Ideris\Model;

use Ideris\Classes\ModelItemBase;

/**
 * Class Marketplace
 * @package Ideris\Model
 */
class Marketplace extends ModelItemBase
{
    protected $attributeMap = [
        "id"        => "Integer",
        "descricao" => "String",
    ];
}