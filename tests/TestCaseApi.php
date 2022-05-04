<?php

namespace Tests;

use Faker\Factory;
use Faker\Generator;
use Ideris\Api\Ideris;
use PHPUnit\Framework\TestCase;

class TestCaseApi extends TestCase
{
    protected $login_token;

    /**
     * @var Ideris
     */
    protected $iderisSdk;

    /**
     * @var Generator
     */
    protected $faker;

    protected function setUp(): void
    {
        $this->login_token = getenv('LOGIN_TOKEN');
    }

    protected function getIderisSdk(): Ideris
    {
        $this->iderisSdk = new Ideris($this->login_token);
        return $this->iderisSdk;
    }

    protected function faker(): Generator
    {
        if (null === $this->faker)
            $this->faker = Factory::create('pt_BR');

        return $this->faker;
    }
}