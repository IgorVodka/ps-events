@extends('main')
@inject('util', 'App\Util\BladeUtil')

@section('title', $slot->event->name)

@section('content')
    <h1>{{ $slot->event->name }}</h1>

    <p>
        Активация завершена! Вы успешно зарегистрировались на мероприятие "{{ $slot->event->name }}" на {{ $slot->name }}!
    </p>
@endsection
