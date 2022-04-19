<?php

namespace Tests;

use Ideris\Api\Ideris;
use Ideris\Client\ApiException;
use Ideris\Model\Auth as AuthModel;

class AuthTest extends TestCaseApi
{
    public function testAuthentication(): void
    {
        $iderisSdk = new Ideris($this->login_token);

        /** @var AuthModel $authModel */
        $authModel = $iderisSdk->auth()->authentication($this->login_token);

        $this->assertInstanceOf(AuthModel::class, $authModel);
    }

    public function testAuthenticationFailure(): void
    {
        try {
            $iderisSdk = new Ideris('chaveInvalida');
        } catch (\Exception $exception) {
            $this->assertInstanceOf(ApiException::class, $exception);
            $this->assertEquals(401, $exception->getCode());
        }
    }
}