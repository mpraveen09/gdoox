<?php

namespace Gdoox\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'paypal/*',
        'account/payment/success',
		'account/payment/ipn',
        'product/payment/success',
        'checkout/payment/confirm'
    ];
}