<?php

namespace PagarMe;

use GuzzleHttp\Exception\ClientException;
use PagarMe\Exceptions\PagarMeException;
use PagarMe\Exceptions\InvalidJsonException;

class ResponseHandler
{
    /**
     * @param string $payload
     *
     * @return \ArrayObject
     *@throws InvalidJsonException
     */
    public static function success(string $payload): \ArrayObject
    {
        return self::toJson($payload);
    }

    /**
     * @param ClientException $originalException
     *
     * @throws PagarMeException
     * @return void
     */
    public static function failure(\Exception $originalException): void
    {
        throw self::parseException($originalException);
    }

    /**
     * @param ClientException $guzzleException
     *
     * @return PagarMeException
     */
    private static function parseException(ClientException $guzzleException): PagarMeException
    {
        $response = $guzzleException->getResponse();
    
        $body = $response->getBody()->getContents();

        try {
            $responseAsArray = self::toJson($body);
        } catch (InvalidJsonException $invalidJson) {
            $responseAsArray = [];
        }

        return new PagarMeException(
            $responseAsArray["message"] ?? "An error occurred",
            $response->getStatusCode(),
            $responseAsArray["errors"] ?? [],
            $body
        );
    }

    /**
     * @param string $json
     * @return \ArrayObject
     * @throws InvalidJsonException
     */
    private static function toJson(string $json): \ArrayObject
    {
        $result = json_decode($json, true);

        if (json_last_error() != \JSON_ERROR_NONE) {
            throw new InvalidJsonException(json_last_error_msg());
        }

        return $result;
    }
}
