<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $post_data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post_data)
    {
        $this->post_data = $post_data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('notify')
        ->with(['data' => $this->post_data])
        ->subject('New Post Notification!');
    }
}
