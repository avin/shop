@extends('layouts.master')

@section('content')

    {{ Former::populate( $user ) }}

    {!! Former::horizontal_open()
        ->secure()
        ->action(action('Front\ProfileController@save'))
        ->rules(['name' => 'required', 'full_name' => 'required'])
        ->method('PUT') !!}

    {!! Former::legend("My profile") !!}

    @include('errors.list')

    {!! Former::text('login') !!}
    {!! Former::text('full_name') !!}

    <hr>

    {!! Former::password('password')->label('New password') !!}
    {!! Former::password('password_confirmation') !!}

    <hr>

    {!! Former::actions()->large_primary_submit('Update profile') !!}

    {!! Former::close() !!}

@stop