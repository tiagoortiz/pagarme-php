<?php

namespace PagarMe;

class RequestHandler
{
    /**
     * @param array $options
     * @param string $apiKey
     *
     * @return array
     */
    public static function bindApiKeyToHeader(array $options, string $apiKey): array
    {
        $options['headers']['Authorization'] = 'Basic ' . base64_encode($apiKey.':');

        return $options;
    }
}
