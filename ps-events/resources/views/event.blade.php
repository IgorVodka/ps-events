@extends('main')
@inject('util', 'App\Util\BladeUtil')

@section('title', $event->name)

@section('content')
    <h1>{{ $event->name }}</h1>

    <p>
        <strong>Регистрация до: {{ $event->getFormattedClosingTime() }}</strong>
    </p>

    <p>{{ $event->description }}</p>
    <hr />

    @if ($event->isRegistrationOpen())
        <legend>Регистрация</legend>
        <p>Выберите удобное время:</p>

        @foreach ($event->slots as $slot)
            <div class="row my-2 ml-0">
                @if ($slot->sparePlaces() === 0)
                    <a href="#" class="btn btn-outline-primary btn-lg btn-block col-md-4 disabled">
                        {{ $slot->name }}
                    </a>
                    <div class="col-md-8 small">
                        К сожалению, на это время больше нет мест.
                    </div>
                @else
                    <a href="{{ url("slot/{$slot->id}") }}" class="btn btn-primary btn-lg btn-block col-md-4">
                        {{ $slot->name }}
                    </a>
                    <div class="col-md-8 small">
                        @if ($slot->participants->count() === 0)
                            На это время пока никто не зарегистрировался.
                        @else
                            На это время
                            {{
                                $util->pluralize(
                                    $slot->participants->count(), [
                                        'зарегистрирован %d человек',
                                        'зарегистрированы %d человека',
                                        'зарегистрированы %d человек'
                                    ]
                                )
                            }}.
                        @endif
                        <br />
                        Есть ещё
                        {{ $util->pluralize($slot->sparePlaces(), ['%d место', '%d места', '%d мест']) }}.
                    </div>
                @endif
            </div>
        @endforeach
    @else
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Регистрация закрыта</h4>
            <div>Сожалеем, но регистрация на это событие уже закрыта.</div>
        </div>
    @endif
@endsection
