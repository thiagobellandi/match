<?php

namespace App\files;

use Firebase\JWT\Key;

class JwtGenerate
{
    //
    protected $_key = '@#4!#09$3';

    //
    public function JwtGenerate()
    {

    }

    //
    public function encodeJwt($params): string
    {
        return \Firebase\JWT\JWT::encode($params, $this->_key, 'HS256');
    }

    //
    public function decodeJwt($token): array
    {
        return (array) \Firebase\JWT\JWT::decode($token, new Key($this->_key, 'HS256'));
    }
}