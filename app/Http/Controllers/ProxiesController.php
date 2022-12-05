<?php

namespace App\Http\Controllers;

use App\Services\Proxy\ProxyService;
use Illuminate\Http\Request;

class ProxiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function list(Request $request, ProxyService $proxyService): \Illuminate\Http\JsonResponse
    {
        $list = $proxyService->getProxies();

        return response()->json($list);
    }
}
