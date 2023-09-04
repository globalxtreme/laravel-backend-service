<?php

namespace App\Http\Middleware\Traits;

trait HasIdentifierToken
{
    /**
     * @param $token
     *
     * @return mixed
     */
    protected function decrypt($token)
    {
        $token = base64_decode($token);

        [$iv, $explodeToken] = [substr($token, 0, 16), explode('-:-', substr($token, 16))];
        [$secret, $actualEncryption] = [substr($explodeToken[1], 0, $explodeToken[0]), substr($explodeToken[1], $explodeToken[0])];

        return json_decode(gzuncompress(openssl_decrypt($actualEncryption, "aes-256-cbc", $secret, 0, $iv)), true);
    }
}
