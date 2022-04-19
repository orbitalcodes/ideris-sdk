<?php

namespace Ideris\Endpoints;

use Ideris\Classes\EndpointBase;
use Ideris\Model\Auth as AuthModel;

class Auth extends EndpointBase
{
    const PREFIX_KEY_STATE = 'ideris_jwt_token_';

    /**
     * Ação POST responsável por trazer o token de autenticação. Para criação do token utilizamos JWT, que define uma
     * maneira compacta e independente de transmitir com segurança informações entre as partes como um objeto JSON.
     *
     * @see https://documenter.getpostman.com/view/4554319/S1a63SJM#b3db6589-2654-4fb1-994b-8b485fc2c4be
     *
     * @return AuthModel
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function authentication(string $login_token): AuthModel
    {
        $response = $this->request('post', '/Login', [
            'json' => ['login_token' => $login_token]
        ]);

        $jwt_token = str_replace('"', '', $response->getBody()->getContents());

        return new AuthModel(['jwt_token' => $jwt_token]);
    }
}