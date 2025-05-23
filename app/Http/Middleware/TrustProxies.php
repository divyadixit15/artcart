<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Symfony\Component\HttpFoundation\Response;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array<int, string>
     */
    protected $proxies;

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    protected $headers = Request::HEADER_X_FORWARDED_ALL;

    /**
     * Constructor for TrustProxies.
     */
    public function __construct()
    {
        // Example: Trust all proxies (you can change this based on your needs)
        $this->proxies = '*'; // or specify IPs as array ['192.168.1.1', '192.168.1.2']
    }
}
