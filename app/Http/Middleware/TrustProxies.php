<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as MiddlewareTrustProxies;
use Illuminate\Http\Request;

class TrustProxies extends MiddlewareTrustProxies
{
    protected $proxies = '*';

    protected $headers = Request::HEADER_X_FORWARDED_FOR |
                         Request::HEADER_X_FORWARDED_HOST |
                         Request::HEADER_X_FORWARDED_PORT |
                         Request::HEADER_X_FORWARDED_PROTO |
                         Request::HEADER_X_FORWARDED_PREFIX |
                         Request::HEADER_X_FORWARDED_AWS_ELB;
}
