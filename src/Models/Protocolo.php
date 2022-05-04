<?php


namespace Ideris\Models;

use Ideris\Classes\ModelItemBase;

/**
 * Class Protocol
 * @package Ideris\Model
 * @property int $id
 * @property \DateTime $dataCriacao
 * @property string $codigo
 * @property string $tipoFeed
 * @property string $status
 * @property string $mensagem
 */
class Protocolo extends ModelItemBase
{
    protected $attributeMap = [
        "id"          => "int",
        "dataCriacao" => "DateTime",
        "codigo"      => "string",
        "tipoFeed"    => "string",
        "status"      => "string",
        "mensagem"    => "string",
    ];
}