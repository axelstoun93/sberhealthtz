<?php

namespace App\Exceptions\Components\ExchangeRate;

use Exception;
use Throwable;
use Illuminate\Support\Facades\Log;

/**
 *  Данный Exception будет обрабатывать ошибки получаемые от
 *  компонентов котировок
 * Class ExchangeRateException
 * @package App\Exceptions\Components\ExchangeRate
 */
class ExchangeRateException extends Exception
{
    /**
     * ExchangeRateException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->writeLog($message);
    }

    /**
     * Все ошибки на текущий момент просто пищем в laravel log
     * @param $message
     */
    private function writeLog($message)
    {
        Log::error($message);
    }
}
