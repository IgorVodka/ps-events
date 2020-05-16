<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Mail\ActivationLetter;
use App\Model\Slot;
use App\Model\Participant;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Mail;

class SlotController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showSlot(Slot $slot)
    {
        return view('slot', ['slot' => $slot]);
    }

    public function submitSlot(Slot $slot, RegisterRequest $request)
    {
        $participant = new Participant($request->all());
        $participant->slot_id = $slot->id;
        $participant->save();

        Mail::to($participant->email)->send(new ActivationLetter($participant));

        return view('activation-needed', ['slot' => $slot, 'participant' => $participant]);
    }
}
