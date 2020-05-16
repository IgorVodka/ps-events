@extends('main')
@inject('util', 'App\Util\BladeUtil')

@section('title', $event->name)

@section('content')
    <h1>Изменение мероприятия <a href="{{ url("event/{$event->id}") }}">{{ $event->name }}</a></h1>

    @foreach ($event->slots as $index => $slot)
        <legend>
            Слот № {{ $index }}
        </legend>

        <div class="form-group col-md-12">
            <label for="slotName">Назание слота (время):</label>
            <input type="text" class="form-control" name="name" id="slotName" placeholder="10:00" value="{{ old('name') }}">
        </div>

        <div class="form-group col-md-12">
            <label for="capacity">Максимальное число участников:</label>
            <input type="number" class="form-control" name="name" id="capacity" placeholder="3" value="{{ old('capacity') }}">
        </div>

        <hr />
    @endforeach
@endsection
