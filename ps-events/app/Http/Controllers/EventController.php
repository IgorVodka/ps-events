<?php

namespace App\Http\Controllers;

use App\Model\Event;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

class EventController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showEvent(Event $event)
    {
        return view('event', ['event' => $event]);
    }
}
