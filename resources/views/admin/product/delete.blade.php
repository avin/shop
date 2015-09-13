@extends('layouts.admin')

@section('content')

    {!! Former::horizontal_open()
        ->secure()
        ->action(action('Admin\ProductController@destroy', [$product->_id]))
        ->method('DELETE') !!}

    {!! Former::legend("Delete \"{$product->name}\"") !!}

    @include('errors.list')

    {!! Former::actions(
            "Are you sure want to delete product {$product->name} ?"
        ) !!}

    <hr>

    {!! Former::actions(
            Former::large_danger_submit('Delete'),
            Html::link(URL::previous(), 'Cancel', ['class' => 'btn btn-default'])
        ) !!}


    {!! Former::close() !!}

@stop
