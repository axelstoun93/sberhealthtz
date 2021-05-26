<?php

namespace App\Events\Article;

use App\Components\ExchangeRate\Cbr\CbrExchangeRate;
use App\Services\ExchangeRateService;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Событие вызывается после сохранения текста статьи
 * Class ArticleSaveText
 * @package App\Events\Article
 */
class ArticleSaveText
{
    use Dispatchable,InteractsWithSockets,SerializesModels;

    public $exchangeRateService;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(){
        $this->exchangeRateService = new ExchangeRateService(new CbrExchangeRate());
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('article-save-text');
    }
}
