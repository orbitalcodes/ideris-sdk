<?php


namespace Ideris\Models;

use Ideris\Classes\ModelItemBase;

/**
 * Class Status
 * @package Ideris\Model
 */
class Status extends ModelItemBase
{
    protected $attributeMap = [
        "id"        => "int",
        "descricao" => "string",
        "modulo"    => "string",
    ];
}