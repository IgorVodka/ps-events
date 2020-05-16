<?php

namespace App\Http\Controllers;

use App\Model\Event;
use App\Model\Participant;
use App\Util\ParticipantsSpreadsheet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function listEventParticipants(Event $event)
    {
        return view('admin.event', ['event' => $event]);
    }

    public function deleteParticipant(Participant $participant)
    {
        $participant->delete();
        return back();
    }

    public function export(Event $event): Response
    {
        $spreadsheet = new ParticipantsSpreadsheet($event);
        return $spreadsheet->generate();
    }

    public function edit()
    {

    }
}
