<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\Proxy\ProxyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ProxiesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * @param ProxyService $proxyService
     *
     * @return JsonResponse
     */
    public function list(ProxyService $proxyService): JsonResponse
    {
        $list = $proxyService->getProxies();
        return response()->json($list);
    }

    /**
     * @param Request $request
     * @param ProxyService $proxyService
     *
     * @return StreamedResponse
     */
    public function export(Request $request, ProxyService $proxyService): StreamedResponse
    {

        $allowedFormats = implode(',', ProxyService::ALLOWED_FORMATS);

        $request->validate(
            [
                'format' => 'required|in:' . $allowedFormats,
            ]
        );

        $format = $request->get('format');

        return $proxyService->export($format);
    }
}
