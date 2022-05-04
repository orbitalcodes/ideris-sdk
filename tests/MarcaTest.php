<?php

namespace Tests;

use Ideris\Classes\Collection;
use Ideris\Collections\Produto\Marcas;
use Ideris\Models\Produto\Marca;

class MarcaTest extends TestCaseApi
{
    public function testCreateRandomMarca(): void
    {
        $descricao = $this->faker()->words(2, true);

        $marcaModel = new Marca([
            'descricao' => $descricao,
        ]);

        $this->assertInstanceOf(Marca::class, $marcaModel);

        $marcaReturned = $this->getIderisSdk()->marca()->create($marcaModel);

        $this->assertInstanceOf(Marca::class, $marcaReturned);
        $this->assertEquals($descricao, $marcaReturned->descricao);

        $marcaFinded = $this->getIderisSdk()->marca()->getById($marcaReturned->id);

        $this->assertInstanceOf(Marca::class, $marcaFinded);
        $this->assertEquals($descricao, $marcaFinded->descricao);
    }

    /**
     * @depends testCreateRandomMarca
     */
    public function testGetMarcas(): void
    {
        $marcas = $this->getIderisSdk()->marca()->get();

        $this->assertInstanceOf(Marcas::class, $marcas);
        $this->assertInstanceOf(Collection::class, $marcas);
        $this->assertInstanceOf(Marca::class, $marcas->first());
    }

    /**
     * @depends testCreateRandomMarca
     */
    public function testGetMarcasPaginate(): void
    {
        $marcas = $this->getIderisSdk()->marca()->get();

        $this->assertEquals(0, $marcas->getOffset());
        $this->assertTrue($marcas->getCount() <= $marcas->getLimit());
    }

    /**
     * @depends testCreateRandomMarca
     */
    public function testGetMarcasOffsetLimit(): void
    {
        $marcas = $this->getIderisSdk()->marca()->get(null, 1, 5);

        $this->assertEquals(1, $marcas->getOffset());
        $this->assertTrue($marcas->getLimit() === 5);
    }
}