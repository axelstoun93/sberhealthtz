<?php

namespace App\Components\ExchangeRate\Api\Data;

use App\Components\ExchangeRate\ExchangeRate;

/**
 * Interface сервиса по котировкам валют
 */
interface ExchangeRateServiceInterface
{
    /**
     * Конструктор ожидает компонент котировок валют
     * ExchangeRateServiceInterface constructor.
     * @param ExchangeRate $exchangeRate
     */
    public function __construct(ExchangeRate $exchangeRate);

    /**
     * Метод возвращает котировку
     * доллара на момент запроса
     * @return float
     */
    public function getRateUsd(): float;
}
