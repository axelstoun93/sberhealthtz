<?php

namespace App\Services;

use App\Components\ExchangeRate\Api\Data\ExchangeRateServiceInterface;
use App\Components\ExchangeRate\ExchangeRate;

/**
 * Сервис работает с компонентами денежных котировок
 * @package App\Services
 */
class ExchangeRateService implements ExchangeRateServiceInterface
{

    /**
     * Компонент денежных котировок
     * @var ExchangeRate
     */
    private $exchangeRate;

    /**
     * Метод ожидает компонент денежных котировок
     * @param ExchangeRate $exchangeRate
     */
    public function __construct(ExchangeRate $exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * Метод возвращает котировку
     * доллара на момент запроса
     * @return float
     */
    public function getRateUsd(): float
    {
       return $this->exchangeRate->getRateUsd();
    }
}
