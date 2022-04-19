<?php

namespace Tests;

use Ideris\Api\Ideris;
use Ideris\Classes\Collection;
use Ideris\Model\Update;
use Ideris\Model\Updates;

class UpdateTest extends TestCaseApi
{
    public function testGetUpdates(): void
    {
        $iderisSdk = new Ideris($this->login_token);
        $updates = $iderisSdk->update()->get();
        $this->assertInstanceOf(Updates::class, $updates);
        $this->assertInstanceOf(Collection::class, $updates);
        $this->assertInstanceOf(Update::class, $updates->first());
    }

    public function testGetUpdatesPaginate(): void
    {
        $iderisSdk = new Ideris($this->login_token);
        $updates = $iderisSdk->update()->get();

        $this->assertEquals(0, $updates->getOffset());
        $this->assertTrue($updates->getCount() <= $updates->getLimit());
    }

    public function testGetUpdatesOffsetLimit(): void
    {
        $iderisSdk = new Ideris($this->login_token);
        $updates = $iderisSdk->update()->get(2, 5);

        $this->assertEquals(2, $updates->getOffset());
        $this->assertTrue($updates->getCount() === 5);
        $this->assertTrue($updates->getTotal() <= 50);
        $this->assertTrue($updates->getLimit() === 5);
    }
}