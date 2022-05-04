<?php


namespace Ideris\Models\Produto;

use Ideris\Classes\ModelItemBase;
use Ideris\Collections\Produto\Imagens;
use Ideris\Collections\Produto\ProdutosCompostos;
use Ideris\Collections\Produto\Variacoes;

/**
 * Class Produto
 * @package Ideris\Model
 */
class Produto extends ModelItemBase
{
    protected $attributeMap = [
        "sku"                        => 'string',
        "titulo"                     => 'string',
        "descricaoLonga"             => 'string',
        "categoriaML"                => 'string',
        "categoriaIdIderis"          => 'int',
        "subCategoriaIdIderis"       => 'int',
        "marcaIdIderis"              => 'int',
        "departamentoIdIderis"       => 'int',
        "ncmId"                      => 'int',
        "produtoOrigemId"            => 'int',
        "modelo"                     => 'string',
        "garantia"                   => 'string',
        "videoYoutube"               => 'string',
        "peso"                       => 'decimal',
        "comprimento"                => 'decimal',
        "largura"                    => 'decimal',
        "altura"                     => 'decimal',
        "pesoEmbalagem"              => 'decimal',
        "comprimentoEmbalagem"       => 'decimal',
        "larguraEmbalagem"           => 'decimal',
        "alturaEmbalagem"            => 'decimal',
        "cest"                       => 'string',
        "ean"                        => 'string',
        "valorCusto"                 => 'decimal',
        "valorVenda"                 => 'decimal',
        "dataValidade"               => \DateTime::class,
        "quantidadeEstoquePrincipal" => 'int',
        "Variacao"                   => Variacoes::class,
        "Imagem"                     => Imagens::class,
        "ProdutoComposto"            => ProdutosCompostos::class,
    ];
}