<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        '/checkout',
        '/rateproperty',
        '/bookmarkdeal',
        '/viewapplication',
        '/updateprofile',
        '/postdeal',
        '/cancelapplication',
        '/accept',
        '/reject',
        '/review',
        '/deletedeal',
        '/updatepassword',
    ];
}

// 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
