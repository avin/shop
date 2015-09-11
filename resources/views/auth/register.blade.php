@extends('layouts.auth')

@section('content')


    <form action="{!! action('Auth\AuthController@postRegister') !!}" method="POST" class="smart-form client-form">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <header>
            Регистрация
        </header>

        <fieldset>

            <section>
                <label class="label">Логин</label>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                    <input type="text" name="name" value="{{ old('name') }}">
                </label>
            </section>

            <section>
                <label class="label">Имя пользователя</label>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                    <input type="text" name="username" value="{{ old('username') }}">
                </label>
            </section>

            <section>
                <label class="label">Email</label>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                    <input type="text" name="email" value="{{ old('email') }}">
                </label>
            </section>

            <section>
                <label class="label">Пароль</label>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                    <input type="password" name="password">
                </label>
            </section>

            <section>
                <label class="label">Подтверждение пароля</label>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                    <input type="password" name="password_confirmation">
                </label>
            </section>

        </fieldset>

        <footer>
            <button type="submit" id="register" class="btn btn-primary">Зарегистрироваться</button>
            <a href="{!! action('Auth\AuthController@getLogin') !!}" class="text-center new-account">
                Уже есть учетная запись? Войти!
            </a>
        </footer>


    </form>


@stop