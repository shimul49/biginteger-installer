<?php

namespace BigInteger\LaravelInstaller\Services;

class RequirementService
{
    public function check(): array
    {
        return [
            [
                'name' => 'PHP Version (>= 8.2)',
                'current' => PHP_VERSION,
                'status' => version_compare(PHP_VERSION, '8.2.0', '>=')
            ],
            [
                'name' => 'BCMath Extension',
                'current' => extension_loaded('bcmath') ? '✓' : '✗',
                'status' => extension_loaded('bcmath')
            ],
            [
                'name' => 'Ctype Extension',
                'current' => extension_loaded('ctype') ? '✓' : '✗',
                'status' => extension_loaded('ctype')
            ],
            [
                'name' => 'JSON Extension',
                'current' => extension_loaded('json') ? '✓' : '✗',
                'status' => extension_loaded('json')
            ],
            [
                'name' => 'OpenSSL Extension',
                'current' => extension_loaded('openssl') ? '✓' : '✗',
                'status' => extension_loaded('openssl')
            ],
            [
                'name' => 'PDO Extension',
                'current' => extension_loaded('pdo') ? '✓' : '✗',
                'status' => extension_loaded('pdo')
            ],
            [
                'name' => 'Tokenizer Extension',
                'current' => extension_loaded('tokenizer') ? '✓' : '✗',
                'status' => extension_loaded('tokenizer')
            ]
        ];
    }
} 