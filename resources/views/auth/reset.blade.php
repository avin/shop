@extends('layouts.auth')

@section('content')

    <form action="{!! action('Auth\PasswordController@postReset') !!}" method="POST" class="smart-form client-form">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <header>
            Сброс пароля
        </header>

        <fieldset>

            <section>
                <label class="label">E-Mail</label>
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
            <button type="submit" class="btn btn-primary">
                Сбросить пароль
            </button>
        </footer>

    </form>

@stop