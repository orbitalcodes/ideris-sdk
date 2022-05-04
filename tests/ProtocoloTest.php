<?php

namespace Tests;

use Ideris\Classes\Collection;
use Ideris\Collections\Protocolos;

class ProtocoloTest extends TestCaseApi
{
    public function testGetProtocols(): void
    {
        $protocols = $this->getIderisSdk()->protocol()->get();

        $this->assertInstanceOf(Protocolos::class, $protocols);
        $this->assertInstanceOf(Collection::class, $protocols);
    }

    public function testGetProtocolsPaginate(): void
    {
        $protocol = $this->getIderisSdk()->protocol()->get();

        $this->assertEquals(0, $protocol->getOffset());
        $this->assertTrue($protocol->getCount() <= $protocol->getLimit());
    }

    public function testGetProtocolsOffsetLimit(): void
    {
        $protocol = $this->getIderisSdk()->protocol()->get(2, 10);
        $this->assertEquals(2, $protocol->getOffset());
    }
}