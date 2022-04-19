<?php


namespace Ideris\Model;

use Ideris\Classes\ModelItemBase;

/**
 * @method getJwtToken(): string
 * @method setJwtToken(string $jwt_token)
 */
class Auth extends ModelItemBase
{
    protected $attributeMap = [
        "jwt_token" => "string",
    ];

    /**
     * @var string
     */
    protected $jwt_token;
}