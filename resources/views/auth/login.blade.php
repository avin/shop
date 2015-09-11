@extends('layouts.auth')

@section('content')

    <form action="{!! action('Auth\AuthController@postLogin') !!}" method="POST" class="smart-form client-form">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <header>
            {{ Lang::get('labels.log_in_form_header') }}
        </header>

        <fieldset>

            <section>
                <label class="label">Email</label>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                    <input type="text" name="email" value="{{ old('email') }}">
                </label>
            </section>

            <section>
                <label class="label">Пароль</label>
                <label class="input"> <i class="icon-append fa fa-lock"></i>
                    <input type="password" name="password" value="">
                </label>
            </section>

            <section>
                <label class="checkbox">
                    <input type="checkbox" name="remember" checked="checked">
                    <i></i>{{ Lang::get('labels.rememberMe') }}
                </label>
            </section>

        </fieldset>

        <footer>
            <button type="submit" class="btn btn-primary" id="logIn">
                {{ Lang::get('labels.log_in') }}
            </button>
            <a href="{!! action('Auth\AuthController@getRegister') !!}">{{ Lang::get('labels.registration') }}</a><br/>
            <a href="{!! action('Auth\PasswordController@getEmail') !!}">Восстановить пароль</a>
        </footer>

    </form>

@stop
