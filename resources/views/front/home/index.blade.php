@extends('layouts.master')

@section('content')

    @if (Auth::check())
        <span>{!! link_to_action('Auth\AuthController@getLogout', $title = 'Logout') !!}, {{ Auth::user()->login }}!</span>
    @else
        <span>{!! link_to_action('Auth\AuthController@getLogin', $title = 'Login') !!}</span>
            <span>{!! link_to_action('Auth\AuthController@getRegister', $title = 'Register') !!}</span>
    @endif

    <hr>

    <h1>This is homepage</h1>
@stop