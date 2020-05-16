@extends('main')
@inject('util', 'App\Util\BladeUtil')

@section('title', $slot->event->name)

@section('content')
    <h1>{{ $slot->event->name }}</h1>

    <p>
        Вы почти у цели! На вашу почту {{ $participant->email }} отправлена ссылка.
    </p>
    <p>
        Перейдите по ней, чтобы зарегистрироваться.
    </p>
@endsection
