<?php

namespace App\Components\ExchangeRate;

/**
 * Interface компонентов по котировкам валют
 */
interface ExchangeRate
{
  /**
  * Сообщение об ошибке при получении Exception
  */
  const ERROR_MESSAGE = 'Сервис курса валют недоступен, попробуйте позже.';

  /**
  * Метод возвращает котировку
  * доллара на момент запроса
  * @return float
  */
  public function getRateUsd() :float;
}
