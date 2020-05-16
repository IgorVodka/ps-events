@extends('main')
@inject('util', 'App\Util\BladeUtil')

@section('title', $event->name)

@section('content')
    <h1>Список участников</h1>

    <p>
        Мероприятие: <a href="{{ url("event/{$event->id}") }}">{{ $event->name }}</a>
    </p>

    <a class="btn btn-success" href="{{ url("/admin/{$event->id}/export") }}">Скачать в XLSX</a>
    <a class="btn btn-success" href="{{ url("/admin/{$event->id}/edit") }}">Изменить мероприятие</a>

    <hr />

    @foreach ($event->slots as $slot)
        <legend>{{ $slot->name }} ({{ $slot->occupiedPlaces() }} / {{ $slot->capacity }} занято)</legend>

        <table class="table table-condensed table-hover table-striped small">
            <thead>
                <th>ID</th>
                <th>Имя</th>
                <th>Группа</th>
                <th>Студенческий билет</th>
                <th>Электронная почта</th>
                <th>Телефон</th>
                <th>ВК</th>
                <th></th>
            </thead>
        @foreach ($slot->participants as $participant)
            @if ($participant->activated)
            <tr>
            @else
            <tr style="opacity: 0.3;">
            @endif
                <td>{{ $participant->id }}</td>
                <td>{{ $participant->name }}</td>
                <td>{{ $participant->group }}</td>
                <td>{{ $participant->student_ticket }}</td>
                <td>{{ $participant->email }}</td>
                <td>{{ $participant->phone }}</td>
                <td><a href="https://vk.com/{{ $participant->vk_link }}">{{ $participant->vk_link }}</a></td>
                <td>
                    <a class="btn btn-warning" onclick="return confirm('Вы уверены?');" href="{{ url("/admin/delete/{$participant->id}") }}">Удалить</a>
                </td>
            </tr>
        @endforeach
        </table>
        <hr />
    @endforeach
@endsection
