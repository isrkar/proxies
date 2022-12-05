<?php
declare(strict_types=1);

namespace App\Dto;

use Exception;

class ProxyDto
{
    public string  $ip;
    public string  $port;
    public string  $login;
    public string  $password;
    private string $format;

    public function setStringFormat($format): self
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function __toString(): string
    {
        $attributes = preg_split('/(:|@)/ui', $this->format); // ip:port@login:password
        preg_match_all('/(:|@)/ui', $this->format, $separators);

        $output = '';
        foreach ($attributes as $i => $attribute) {
            if (false === in_array($attribute, get_class_vars(self::class))) {
                throw new Exception('Unexpected attribute provided');
            }

            $output .= $this->$attribute . ($separators[0][$i] ?? '');
        }

        return $output;
    }
}
