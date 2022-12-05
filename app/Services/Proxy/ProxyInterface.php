<?php
declare(strict_types=1);

namespace App\Services\Proxy;

use App\Dto\ProxyDto;

interface ProxyInterface
{
    /**
     * @return ProxyDto[]
     */
    public function getProxies(): array;
}
