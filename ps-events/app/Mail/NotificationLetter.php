<?php

namespace App\Mail;

use App\Model\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationLetter extends Mailable
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
            ->subject("Подтверждено участие в мероприятии {$event->name}")
            ->text('mail.notification')
            ->with([
               'event' => $event,
               'participant' => $this->participant
            ]);
    }
}
