@extends('layouts.auth')

@section('custom-style')
    <style>
        body{
            padding-top: 20px;
        }
    </style>
@stop

@section('content')

    {!! Former::horizontal_open()
        ->secure()
        ->action(action('Auth\AuthController@postLogin'))
        ->rules(['email' => 'required|email', 'password' => 'required'])
        ->method('POST') !!}

    {!! Former::text('email')->autofocus() !!}
    {!! Former::password('password') !!}

    {!! Former::checkbox('remember')
        ->label(' ')
        ->text('Remember me')
        ->check() !!}

    {!! Former::actions()
    ->large_primary_submit('Login')
    ->large_inverse_reset('Reset') !!}

    {!! Former::close() !!}

@stop
