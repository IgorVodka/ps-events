@extends('main')
@inject('util', 'App\Util\BladeUtil')

@section('title', "{$slot->event->name} в {$slot->name}")

@section('content')
    <h1>
        {{ $slot->event->name }}
    </h1>
    <a href="{{ url("/event/{$slot->event->id}") }}" class="ml-n2 small">&larr; назад</a>

    <hr />

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            Исправьте эти ошибки и попробуйте ещё раз.
        </div>
    @endif


    @if ($slot->event->isRegistrationOpen() && $slot->sparePlaces() > 0)
        <legend>Регистрация на {{ $slot->name }}</legend>

        <form method="POST" action="">
            @csrf

            <div class="row">
                <div class="form-group col-md-12">
                    <label for="fullName">Ваши имя и фамилия:</label>
                    <input type="text" class="form-control" name="name" id="fullName" placeholder="Иван Иванов" value="{{ old('name') }}">
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="group">Ваша группа:</label>
                    <input type="text" class="form-control" name="group" id="group" placeholder="ИУ1-11Б" value="{{ old('group') }}">
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="studentTicket">Номер студенческого билета:</label>
                    <input type="text" class="form-control" name="student_ticket" id="studentTicket" placeholder="18У001" value="{{ old('student_ticket') }}">
                </div>
                <div class="form-group col-md-12">
                    <label for="email">Ваша электронная почта:</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="student@bmstu.ru" value="{{ old('email') }}">
                    <small id="emailHelp" class="form-text text-muted ml-1">
                        Мы отправим вам подтверждение регистрации на эту почту.
                    </small>
                </div>
                <div class="col-md-12 mb-3">
                    <strong>
                        Пожалуйста, укажите телефон или ссылку на VK, а лучше &mdash; и то, и другое:
                    </strong>
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="phone">Телефон:</label>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="89123456789" value="{{ old('phone') }}">
                </div>
                <div class="form-group col-md-6 col-xs-12">
                    <label for="vkLink">Ссылка на VK</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">https://vk.com/</span>
                        </div>
                        <input type="text" class="form-control" id="vkLink" name="vk_link" placeholder="id12345" value="{{ old('vk_link') }}">
                    </div>
                </div>
                <div class="form-check col-md-12">
                    <input type="checkbox" class="form-check-input" id="agree" name="agree">
                    <label class="form-check-label large" for="agree">
                        {!! $slot->event->agreement !!}
                    </label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg mt-2">
                Зарегистрироваться
            </button>
        </form>
    @else
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Регистрация закрыта</h4>
            <div>Сожалеем, но регистрация на это событие уже закрыта.</div>
        </div>
    @endif
@endsection
