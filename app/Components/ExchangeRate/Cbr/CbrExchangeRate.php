<?php

namespace App\Components\ExchangeRate\Cbr;

use App\Components\ExchangeRate\ExchangeRate;
use App\Exceptions\Components\ExchangeRate\ExchangeRateException;
use GuzzleHttp\Client;

/**
 * Компонент котировок валют
 * Центральный Банк
 * Class CbrExchangeRate
 * @package App\Components\ExchangeRate\Cbr
 */
class CbrExchangeRate implements ExchangeRate
{
    /**
     * @var string
     */
    private static $url = 'http://www.cbr.ru/scripts/XML_daily.asp';

    /**
     * @param $url
     * @return \SimpleXMLElement
     * @throws ExchangeRateException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private static function get($url)
    {
        try {
            $client = new Client();
            $response = $client->get($url, ['verify' => false]);
            $httpCode = $response->getStatusCode();
            $response = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);

            if ($httpCode !== 200) {
                throw new ExchangeRateException(ExchangeRate::ERROR_MESSAGE);
            }

            return $response;
        } catch (\Exception $exception) {
            throw new ExchangeRateException(ExchangeRate::ERROR_MESSAGE);
        }
    }

    /**
     * @return float
     * @throws ExchangeRateException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRateUsd(): float
    {
        try {
            $xmlObject = self::get(self::$url);
            $usdValue = 0;

            foreach ($xmlObject->children() as $currency) {
                if ($currency->CharCode == 'USD') {
                    $usdValue = (float)str_replace(',', ".", $currency->Value);
                    break;
                }
            }

            return $usdValue;
        } catch (\Exception $exception) {
            throw new ExchangeRateException($exception->getMessage());
        }
    }

}
