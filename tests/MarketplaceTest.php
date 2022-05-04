<?php

namespace Tests;

use Ideris\Classes\Collection;
use Ideris\Collections\Marketplaces;
use Ideris\Models\Marketplace;

class MarketplaceTest extends TestCaseApi
{
    public function testGetMarketplaces(): void
    {
        $marketplaces = $this->getIderisSdk()->marketplace()->get();

        $this->assertInstanceOf(Marketplaces::class, $marketplaces);
        $this->assertInstanceOf(Collection::class, $marketplaces);
        $this->assertInstanceOf(Marketplace::class, $marketplaces->first());
    }

    public function testGetMarketplacesPaginate(): void
    {
        $marketplaces = $this->getIderisSdk()->marketplace()->get();

        $this->assertEquals(0, $marketplaces->getOffset());
        $this->assertTrue($marketplaces->getCount() <= $marketplaces->getLimit());
    }

    public function testGetMarketplacesOffsetLimit(): void
    {
        $marketplaces = $this->getIderisSdk()->marketplace()->get(2, 5);

        $this->assertEquals(2, $marketplaces->getOffset());
        $this->assertTrue($marketplaces->getCount() === 5);
        $this->assertTrue($marketplaces->getTotal() <= 50);
        $this->assertTrue($marketplaces->getLimit() === 5);
    }
}