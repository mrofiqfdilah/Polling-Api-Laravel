<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */

     protected $addHttpCookie = true;

    protected $except = [
        //
        'api/auth/login',
        'api/auth/register',
        'api/auth/logout',
        'api/auth/me',
        'api/poll/create',
        'api/poll/get',
        'api/poll/apoll',
        'api/vote',
    ];
}
