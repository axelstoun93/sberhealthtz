<?php

namespace App\Mail\Article;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticleSaveTextMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $usd;

    public $subject = 'Article Notification';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(float $usd)
    {
        $this->usd = $usd;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notifications.article.mail.articlesSaveText',['usd' => $this->usd]);
    }
}
