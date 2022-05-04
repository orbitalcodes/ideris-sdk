<?php


namespace Ideris\Models;

use Ideris\Classes\ModelItemBase;

/**
 * Class Account
 * @package Ideris\Model
 */
class Conta extends ModelItemBase
{
    protected $attributeMap = [
        "idPedido"               => "int",
        "marketplaceId"          => "int",
        "marketplace"            => "string",
        "idAutenticacaoIderis"   => "int",
        "idContaMarketplace"     => "string",
        "nomeContaMarketplace"   => "string",
        "statusContaMarketplace" => "string",
        "mensagemRetorno"        => "string",
    ];
}