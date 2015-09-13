@extends('layouts.admin')

@section('custom-style')
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/select2.css') }}">
@stop

@section('content')

    {!! Former::horizontal_open()
        ->secure()
        ->action(action('Admin\CategoryController@destroy', [$category->_id]))
        ->method('DELETE') !!}

    {!! Former::legend("Delete \"{$category->name}\"") !!}

    @include('errors.list')

    {!! Former::actions(
            "Are you sure want to delete category {$category->name} ?"
        ) !!}

    <hr>

    {!! Former::actions(
            Former::large_danger_submit('Delete'),
            Html::link(URL::previous(), 'Cancel', ['class' => 'btn btn-default'])
        ) !!}


    {!! Former::close() !!}

@stop

@section('custom-script')
    <script>
        $('select').select2();
    </script>
@stop