<?php


namespace Ideris\Models\Produto;

use Ideris\Classes\ModelItemBase;
use Ideris\Collections\Produto\Imagens;

/**
 * Class Variacao
 * @package Ideris\Model
 */
class Variacao extends ModelItemBase
{
    protected $attributeMap = [
        "skuVariacao"        => 'string',
        "quantidadeVariacao" => 'int',
        "nomeAtributo"       => 'string',
        "valorAtributo"      => 'string',
        "Imagem"             => Imagens::class,
    ];
}