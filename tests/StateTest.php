<?php

namespace Tests;

use Ideris\Helper\StateService;
use PHPUnit\Framework\TestCase;

class StateTest extends TestCase
{
    public function testSaveRecoveryState(): void
    {
        $value = 'value1';
        $key = 'key1';

        $stateService = new StateService();

        $sizeSaved = $stateService->saveState($key, $value);

        $this->assertEquals(24, $sizeSaved);

        $this->assertTrue($value == $stateService->getState($key));
    }
}