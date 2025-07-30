<?php

namespace PagarMe\Endpoints;

use PagarMe\Exceptions\PagarMeException;
use PagarMe\Routes;

class Charges extends Endpoint
{
    /**
     * @param array $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function capture(array $payload): \stdClass
    {
        return $this->client->request(
            self::POST,
            Routes::charges()->capture($payload['charge_id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function updateCard(array $payload): \stdClass
    {
        return $this->client->request(
            self::PATCH,
            Routes::charges()->updateCard($payload['charge_id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function updateBillingDue(array $payload): \stdClass
    {
        return $this->client->request(
            self::PATCH,
            Routes::charges()->updateBillingDue($payload['charge_id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function updatePaymentMethod(array $payload): \stdClass
    {
        return $this->client->request(
            self::PATCH,
            Routes::charges()->updatePaymentMethod($payload['charge_id']),
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
            Routes::charges()->base(),
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
            Routes::charges()->details($payload['id'])
        );
    }

    /**
     * @param array $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function confirmCash(array $payload): \stdClass
    {
        return $this->client->request(
            self::POST,
            Routes::charges()->confirmCash($payload['charge_id']),
            ['json' => $payload]
        );
    }

    /**
     * @param array $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function holdCharge(array $payload): \stdClass
    {
        return $this->client->request(
            self::POST,
            Routes::charges()->holdCharge($payload['id'])
        );
    }

    /**
     * @param array $payload
     *
     * @return array
     * @throws PagarMeException
     */
    public function cancel(array $payload): \stdClass
    {
        return $this->client->request(
            self::DELETE,
            Routes::charges()->cancel($payload['charge_id']),
            ['json' => $payload]
        );
    }
}