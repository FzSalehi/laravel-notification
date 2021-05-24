<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TopicCreated extends Mailable
{
    use Queueable, SerializesModels;
    
    private $firstname = 'faraz';
    private $lastname = 'salehi';
    public $introduction = 'a simple mail to a user';
    public $fullname;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->fullname = $this->firstname.' '.$this->lastname;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('topic-created');
    }
}
