<?php

namespace Tests;

use Ideris\Classes\Collection;
use Ideris\Collections\Produto\Imagens;
use Ideris\Collections\Produto\Produtos;
use Ideris\Models\Produto\Imagem;
use Ideris\Models\Produto\Produto;
use Ideris\Models\Produto\ProdutoRetornado;
use Ideris\Models\Protocolo;

class ProdutoTest extends TestCaseApi
{
    public function testCreateRandomSimpleProduto(): array
    {
        $produtoModel = $this->prepareDadosProduto();

        $produtoModel->setImagem([
            ['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png'],
            ['imagemBase64' => $this->getImagemBase64Faker()],
            (new Imagem(['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png']))
        ]);

        $this->assertInstanceOf(Produto::class, $produtoModel);

        $protocoloReturned = $this->getIderisSdk()->produto()->create($produtoModel);

        $this->assertInstanceOf(Protocolo::class, $protocoloReturned);

        return [
            'produtoModel'      => $produtoModel,
            'protocoloReturned' => $protocoloReturned
        ];
    }

    /**
     * @depends testCreateRandomSimpleProduto
     */
    public function testGetBySkuProduto(array $result): Produtos
    {
        sleep(3);

        $produtos = $this->getIderisSdk()->produto()->get($result['produtoModel']->sku);

        $this->assertInstanceOf(Produtos::class, $produtos);
        $this->assertInstanceOf(Collection::class, $produtos);
        $this->assertInstanceOf(ProdutoRetornado::class, $produtos->first());
        $this->assertInstanceOf(Imagens::class, $produtos->first()->getImagens());
        $this->assertEquals(0, $produtos->first()->getImagens()->count());

        $produtos = $this->getIderisSdk()->produto()->get($result['produtoModel']->sku, true);

        $this->assertInstanceOf(Produtos::class, $produtos);
        $this->assertInstanceOf(Collection::class, $produtos);
        $this->assertInstanceOf(ProdutoRetornado::class, $produtos->first());
        $this->assertInstanceOf(Imagens::class, $produtos->first()->getImagens());
        $this->assertTrue($produtos->first()->getImagens()->count() > 0);
        $this->assertInstanceOf(Imagem::class, $produtos->first()->getImagens()->first());

        return $produtos;
    }

    /**
     * @depends testCreateRandomSimpleProduto
     */
    public function testGetProduto(array $result): Produtos
    {
        $produtos = $this->getIderisSdk()->produto()->get();

        $this->assertInstanceOf(Produtos::class, $produtos);
        $this->assertInstanceOf(Collection::class, $produtos);
        $this->assertInstanceOf(ProdutoRetornado::class, $produtos->first());

        return $produtos;
    }

    /**
     * @depends testGetProduto
     */
    public function testGetByIdProduto(Produtos $produtos): ProdutoRetornado
    {
        $produtoFinded = $this->getIderisSdk()->produto()->getById($produtos->first()->id);

        $this->assertInstanceOf(ProdutoRetornado::class, $produtoFinded);
        $this->assertInstanceOf(Imagens::class, $produtoFinded->getImagens());
        $this->assertEquals(0, $produtoFinded->getImagens()->count());

        $produtoFinded = $this->getIderisSdk()->produto()->getById($produtos->first()->id, true);

        $this->assertInstanceOf(ProdutoRetornado::class, $produtoFinded);
        $this->assertInstanceOf(Imagens::class, $produtoFinded->getImagens());
        $this->assertTrue($produtoFinded->getImagens()->count() > 0);
        $this->assertInstanceOf(Imagem::class, $produtoFinded->getImagens()->first());

        return $produtoFinded;
    }

    /**
     * @depends testCreateRandomSimpleProduto
     */
    public function testUpdateSimpleProduto(array $result): Produto
    {
        sleep(3); //Esperando o produto simples confirmar cadastro

        /** @var Produto $produtoModel */
        $produtoModel = new Produto();
        $produtoModel->sku = $result['produtoModel']->sku;
        $produtoModel->titulo = 'Título do produto atualizado pelo SKU';

        $produtoEdited = $this->getIderisSdk()->produto()->update($produtoModel);

        $this->assertInstanceOf(ProdutoRetornado::class, $produtoEdited);
        $this->assertEquals('Título do produto atualizado pelo SKU', $produtoEdited->titulo);

        /** @var Produto $produtoModel */
        $produtoModel = new Produto();
        $produtoModel->id = $produtoEdited->id;
        $produtoModel->titulo = 'Título do produto atualizado pelo ID';

        $produtoEdited = $this->getIderisSdk()->produto()->update($produtoModel);

        $this->assertInstanceOf(ProdutoRetornado::class, $produtoEdited);
        $this->assertEquals('Título do produto atualizado pelo ID', $produtoEdited->titulo);

        return $produtoModel;
    }

    public function testCreateRandomProdutoVariacao(): array
    {
        $produtoModel = $this->prepareDadosProduto();

        $produtoModel->setImagem([
            ['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png'],
            ['imagemBase64' => $this->getImagemBase64Faker()],
            (new Imagem(['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png']))
        ]);

        $skuVariacao1 = $this->faker()->regexify('[A-Z]{5}[0-4]{3}');
        $skuVariacao2 = $this->faker()->regexify('[A-Z]{5}[0-4]{3}');

        $produtoModel->setVariacao([
            [
                "skuVariacao"        => $skuVariacao1,
                "quantidadeVariacao" => $this->faker()->randomNumber(3, true),
                "nomeAtributo"       => 'Tamanho',
                "valorAtributo"      => 'M',
                "Imagem"             => [
                    ['imagemBase64' => $this->getImagemBase64Faker()]
                ]
            ],
            [
                "skuVariacao"        => $skuVariacao2,
                "quantidadeVariacao" => $this->faker()->randomNumber(3, true),
                "nomeAtributo"       => 'Tamanho',
                "valorAtributo"      => 'G',
                "Imagem"             => [
                    ['imagemBase64' => $this->getImagemBase64Faker()]
                ]
            ],
        ]);

        $this->assertInstanceOf(Produto::class, $produtoModel);

        $protocoloReturned = $this->getIderisSdk()->produto()->create($produtoModel);

        $this->assertInstanceOf(Protocolo::class, $protocoloReturned);

        return [
            'produtoModel'      => $produtoModel,
            'protocoloReturned' => $protocoloReturned
        ];
    }

    /**
     * @depends testCreateRandomSimpleProduto
     */
    public function testCreateRandomProdutoComposto(array $result): array
    {
        sleep(3); //Esperando o produto simples confirmar cadastro

        $produtoModel = $this->prepareDadosProduto();

        $produtoModel->setImagem([
            ['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png'],
            ['imagemBase64' => $this->getImagemBase64Faker()],
            (new Imagem(['urlImagem' => $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png']))
        ]);

        $produtoModel->setProdutoComposto([
            [
                "skuProdutoFilho" => $result['produtoModel']->sku,
                "quantidade"      => $this->faker()->randomNumber(3, true),
            ]
        ]);

        $this->assertInstanceOf(Produto::class, $produtoModel);

        $protocoloReturned = $this->getIderisSdk()->produto()->create($produtoModel);

        $this->assertInstanceOf(Protocolo::class, $protocoloReturned);

        return [
            'produtoModel'      => $produtoModel,
            'protocoloReturned' => $protocoloReturned
        ];
    }

    protected function prepareDadosProduto(): Produto
    {
        $categoria = $this->getIderisSdk()->categoria()->get('Geral')->first();
        $subcategoria = $this->getIderisSdk()->subCategoria()->get('Geral')->first();
        $marca = $this->getIderisSdk()->marca()->get('Geral')->first();
        $departamento = $this->getIderisSdk()->departamento()->get('Geral')->first();
        $produtoOrigem = $this->getIderisSdk()->origem()->get()->first();
        $ncm = $this->getIderisSdk()->ncm()->getByCode(NcmTest::$ncmCodigoStatic);

        return new Produto([
            "sku"                        => $this->faker()->regexify('[A-Z]{5}[0-4]{3}'),
            "titulo"                     => $this->faker()->words(2, true),
            "descricaoLonga"             => $this->faker()->sentence(),
//            "categoriaML"                => 'string',
            "categoriaIdIderis"          => $categoria->id,
            "subCategoriaIdIderis"       => $subcategoria->id,
            "marcaIdIderis"              => $marca->id,
            "departamentoIdIderis"       => $departamento->id,
            "ncmId"                      => $ncm->id,
            "produtoOrigemId"            => $produtoOrigem->id,
            "modelo"                     => $this->faker()->word(),
            "garantia"                   => $this->faker()->sentence(),
//            "videoYoutube"               => 'string',
            "peso"                       => $this->faker()->randomFloat(1, 0.1, 10),
            "comprimento"                => $this->faker()->randomFloat(1, 10, 50),
            "largura"                    => $this->faker()->randomFloat(1, 10, 50),
            "altura"                     => $this->faker()->randomFloat(1, 10, 50),
            "pesoEmbalagem"              => $this->faker()->randomFloat(1, 0.1, 1),
            "comprimentoEmbalagem"       => $this->faker()->randomFloat(1, 10, 50),
            "larguraEmbalagem"           => $this->faker()->randomFloat(1, 10, 50),
            "alturaEmbalagem"            => $this->faker()->randomFloat(1, 10, 50),
            "cest"                       => $this->faker()->word(),
            "ean"                        => $this->faker()->ean13(),
            "valorCusto"                 => $this->faker()->randomFloat(1, 10, 50),
            "valorVenda"                 => $this->faker()->randomFloat(1, 51, 100),
            "dataValidade"               => $this->faker()->date(),
            "quantidadeEstoquePrincipal" => $this->faker()->randomNumber(3, true),
        ]);
    }

    protected function getImagemBase64Faker(): string
    {
        $imageRandom = $this->faker()->imageUrl(640, 480, 'Ideris produto teste') . '.png';
        $data = file_get_contents($imageRandom);
        return 'type:image/png;base64:' . base64_encode($data);
    }
}