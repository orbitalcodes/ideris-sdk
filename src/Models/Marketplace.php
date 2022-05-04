<?php


namespace Ideris\Models;

use Ideris\Classes\ModelItemBase;

/**
 * Class Marketplace
 * @package Ideris\Model
 */
class Marketplace extends ModelItemBase
{
    protected $attributeMap = [
        "id"        => "int",
        "descricao" => "string",
    ];
}