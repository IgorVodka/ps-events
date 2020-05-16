<?php

namespace App\Http\Controllers;

use App\Mail\NotificationLetter;
use App\Model\Participant;
use Illuminate\Support\Facades\Mail;

class ParticipantController extends Controller
{
    public function activate(Participant $participant, string $secret)
    {
        // TODO make nice error messages

        if ($participant->getActivationSecret() !== $secret) {
            return 'Неверный код активации. :(';
        }

        if ($participant->slot->sparePlaces() === 0) {
            return 'Места закончились. :(';
        }

        if (!$participant->slot->event->isRegistrationOpen()) {
            return 'Вы не успели. :(';
        }

        $participant->activated = true;
        $participant->save();

        Mail::to($participant->email)->send(new NotificationLetter($participant));

        return view('activation-complete', ['slot' => $participant->slot]);
    }
}
