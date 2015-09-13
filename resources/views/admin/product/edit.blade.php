@extends('layouts.admin')

@section('custom-style')
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('css/select2.css') }}">
@stop

@section('content')

    @if(isset($product))
        {{ Former::populate( $product ) }}
    @endif

    {!! Former::horizontal_open()
        ->secure()
        ->action(ends_with(Route::currentRouteAction(), '@create') ? action('Admin\ProductController@store') : action('Admin\ProductController@update', [$product->_id]))
        ->rules(['name' => 'required', 'price' => 'required', 'description' => ''])
        ->method(ends_with(Route::currentRouteAction(), '@create') ? 'POST' : 'PUT') !!}

    {!! Former::legend(ends_with(Route::currentRouteAction(), '@create') ? 'Create product' : "Edit \"{$product->name}\"") !!}

    @include('errors.list')

    {!! Former::text('name') !!}
    {!! Former::text('price') !!}
    {!! Former::multiselect('categories')->fromQuery($categories, 'name', 'id') !!}
    {!! Former::textarea('description') !!}

    <hr>

    {!! Former::actions()
        ->large_primary_submit(ends_with(Route::currentRouteAction(), '@create') ? 'Create' : 'Save') !!}

    {!! Former::close() !!}

@stop

@section('custom-script')
    <script>
        $('select').select2();
    </script>
@stop