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
        'media/upload',
        'admin/media/upload',
        'admin/galleries/upload-photo/*',
        'user/membership/success-payment',
        'payment/cancel',
        'payment/failed',
        'payment/success',
        'image-upload',
        'test-post',
        '/member/pay-via-ajax', '/member/success','/member/cancel','/member/fail','/member/ipn'
    ];
}
