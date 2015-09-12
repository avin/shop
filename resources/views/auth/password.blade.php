@extends('layouts.auth')

@section('content')

    <form action="{!! action('Auth\PasswordController@postEmail') !!}" method="POST" class="smart-form client-form">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <header>
            Reset password
        </header>

        <fieldset>

            <section>
                <label class="label">E-Mail</label>
                <label class="input"> <i class="icon-append fa fa-user"></i>
                    <input type="text" name="email" value="{{ old('email') }}">
                </label>
            </section>

        </fieldset>

        <footer>
            <button type="submit" class="btn btn-primary">
                Send restore password instructions
            </button>

        </footer>

    </form>

@stop