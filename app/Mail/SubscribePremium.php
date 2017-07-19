<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Subscribe\Subscribe;
use URL;


class SubscribePremium extends Mailable
{
    use Queueable, SerializesModels;


    public $model;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $model = $this->model;
        // $index = route('frontend.subscribe.index');
        $index = URL::to('subscription');
        return $this->view('frontend.emails.subscribe_premium', compact('model', 'index'));
    }
}
