<?php

namespace PagarMe\Endpoints;

use PagarMe\Exceptions\PagarMeException;
use PagarMe\Routes;

class Cards extends Endpoint
{
    /**
     * @param array $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function create(array $payload): \stdClass
    {
        return $this->client->request(
            self::POST,
            Routes::cards()->base($payload['customer_id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function update(array $payload): \stdClass
    {
        return $this->client->request(
            self::PUT,
            Routes::cards()->details($payload['customer_id'], $payload['card_id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array|null $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function getList(array $payload = null): \stdClass
    {
        return $this->client->request(
            self::GET,
            Routes::cards()->base($payload['customer_id']),
            ['query' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function get(array $payload): \stdClass
    {
        return $this->client->request(
            self::GET,
            Routes::cards()->details($payload['customer_id'], $payload['card_id'])
        );
    }

    /**
     * @param array $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function delete(array $payload): \stdClass
    {
        return $this->client->request(
            self::DELETE,
            Routes::cards()->delete($payload['customer_id'], $payload['card_id'])
        );
    }
}
