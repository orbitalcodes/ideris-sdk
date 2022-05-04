<?php

namespace Tests;

use Ideris\Classes\Collection;
use Ideris\Collections\Atualizacoes;
use Ideris\Models\Atualizacao;

class AtualizacaoTest extends TestCaseApi
{
    public function testGetUpdates(): void
    {
        $updates = $this->getIderisSdk()->update()->get();
        $this->assertInstanceOf(Atualizacoes::class, $updates);
        $this->assertInstanceOf(Collection::class, $updates);
        $this->assertInstanceOf(Atualizacao::class, $updates->first());
    }

    public function testGetUpdatesPaginate(): void
    {
        $updates = $this->getIderisSdk()->update()->get();

        $this->assertEquals(0, $updates->getOffset());
        $this->assertTrue($updates->getCount() <= $updates->getLimit());
    }

    public function testGetUpdatesOffsetLimit(): void
    {
        $updates = $this->getIderisSdk()->update()->get(2, 5);

        $this->assertEquals(2, $updates->getOffset());
        $this->assertTrue($updates->getCount() === 5);
        $this->assertTrue($updates->getTotal() <= 50);
        $this->assertTrue($updates->getLimit() === 5);
    }
}