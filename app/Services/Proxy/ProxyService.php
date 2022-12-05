<?php
declare(strict_types=1);

namespace App\Services\Proxy;

use App\Dto\ProxyDto;

class ProxyService implements ProxyInterface
{

    /**
     * @return ProxyDto[]
     */
    public function getProxies(): array
    {
        $qty = rand(10, 30);

        $return = [];
        for ($i = 1; $i <= $qty; $i++) {
            $return[] = $this->generateProxyDto();
        }

        return $return;
    }

    /**
     * @return ProxyDto
     */
    private function generateProxyDto(): ProxyDto
    {
        $proxyDto = new ProxyDto();
        $proxyDto->login = fake()->userName();
        $proxyDto->password = fake()->password();
        $proxyDto->ip = $this->generateIp();
        $proxyDto->port = $this->generatePort();
        return $proxyDto;
    }

    /**
     * @return string
     */
    private function generateIp(): string
    {
        return rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255) . '.' . rand(1, 255);
    }

    /**
     * @return string
     */
    private function generatePort(): string
    {
        return (string)rand(80, 9000);
    }
}
