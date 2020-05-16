<?php

namespace App\Mail;

use App\Model\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ActivationLetter extends Mailable
{
    use Queueable, SerializesModels;

    private $participant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $event = $this->participant->slot->event;

        return $this
            ->subject("Подтвердите участие в мероприятии {$event->name}")
            ->text('mail.activation')
            ->with([
                'event' => $event,
                'participant' => $this->participant
            ]);
    }
}
