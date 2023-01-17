<?php

namespace App\Http\Middleware\Traits;

use Illuminate\Http\Request;

trait HasIdentifierToken
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    protected function decrypt(Request $request)
    {
        $token = $request->header('IDENTIFIER');
        if (!$token) {
            errUnauthenticated();
        }

//        $token = base64_decode($token);
//
//        $cipher = config('app.cipher');
//        $secret = config('base.conf.secret');
//
//        $ivLength = openssl_cipher_iv_length($cipher);
//        $iv = substr($token, 0, $ivLength);
//
//        $decrypt = json_decode(base64_decode(openssl_decrypt(substr($token, $ivLength), $cipher, $secret, 1, $iv)), true);
//        $decrypt = json_decode(base64_decode(openssl_decrypt($decrypt[$secret], $cipher, $secret, 0, $iv)), true);

        return json_decode(base64_decode($token), true);
    }
}
