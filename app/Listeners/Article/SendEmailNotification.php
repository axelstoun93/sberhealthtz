<?php

namespace App\Listeners\Article;

use App\Events\Article\ArticleSaveText;
use App\Mail\Article\ArticleSaveTextMail;
use Illuminate\Support\Facades\Mail;

/**
 * Слушатель
 * отвечает за отправку письма после сохранения текста статьи
 * Class SendEmailNotification
 * @package App\Listeners\Article
 */
class SendEmailNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(ArticleSaveText $event)
    {
        $usd = $event->exchangeRateService->getRateUsd();
        Mail::to(env('MAIL_TEST_ADDRESS'))->send(new ArticleSaveTextMail($usd));
    }
}
