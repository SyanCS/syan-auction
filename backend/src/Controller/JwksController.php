<?php

namespace App\Controller;

use Firebase\JWT\JWT;

class JwksController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function index()
    {
        $pubKey = file_get_contents(CONFIG . './jwt.pem');
        $res = openssl_pkey_get_public($pubKey);
        $detail = openssl_pkey_get_details($res);
        $key = [
            'kty' => 'RSA',
            'alg' => 'RS256',
            'use' => 'sig',
            'e' => JWT::urlsafeB64Encode($detail['rsa']['e']),
            'n' => JWT::urlsafeB64Encode($detail['rsa']['n']),
        ];
        $keys['keys'][] = $key;

        $this->viewBuilder()->setClassName('Json');
        $this->set(compact('keys'));
        $this->viewBuilder()->setOption('serialize', 'keys');
    }
}