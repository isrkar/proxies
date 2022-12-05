<?php
declare(strict_types=1);

namespace App\Services\Proxy;

use App\Dto\ProxyDto;
use Symfony\Component\HttpFoundation\StreamedResponse;

interface ProxyInterface
{
    const ALLOWED_FORMATS = [
        'ip:port@login:password',
        'ip:port',
        'ip',
        'ip@login:password',
    ];

    const DOWNLOAD_NAME = 'export.csv';

    /**
     * @return ProxyDto[]
     */
    public function getProxies(): array;

    /**
     * @param string $format
     *
     * @return StreamedResponse
     */
    public function export(string $format): StreamedResponse;
}
