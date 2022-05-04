<?php

namespace Tests;

use Ideris\Classes\Collection;
use Ideris\Collections\Produto\Origens;
use Ideris\Models\Produto\Origem;

class OrigemTest extends TestCaseApi
{

    public function testGetOrigens(): void
    {
        $origens = $this->getIderisSdk()->origem()->get();

        $this->assertInstanceOf(Origens::class, $origens);
        $this->assertInstanceOf(Collection::class, $origens);
        $this->assertInstanceOf(Origem::class, $origens->first());
    }

    public function testGetNacionalOrigens(): Origem
    {
        $origens = $this->getIderisSdk()->origem()->get();

        $origemNacional = $origens->where('codigo', 0)->first();

        $this->assertInstanceOf(Origem::class, $origemNacional);
        $this->assertEquals(1, $origemNacional->id);
        $this->assertEquals('0- Nacional, exceto as indicadas nos códigos 3, 4, 5 e 8', $origemNacional->descricao);
        $this->assertEquals('0', $origemNacional->codigo);

        return $origemNacional;
    }

    public function testGetOrigensPaginate(): void
    {
        $origens = $this->getIderisSdk()->origem()->get();

        $this->assertEquals(0, $origens->getOffset());
        $this->assertTrue($origens->getCount() <= $origens->getLimit());
    }

    public function testGetOrigensOffsetLimit(): void
    {
        $origens = $this->getIderisSdk()->origem()->get(1, 5);

        $this->assertEquals(1, $origens->getOffset());
        $this->assertTrue($origens->getLimit() === 5);
    }
}