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
    {!! Former::multiselect('category_ids')->label('Categories')->fromQuery($categories, 'name', 'id') !!}
    {!! Former::textarea('description') !!}

    <hr>

    {!! Former::actions(
            Former::large_primary_submit(ends_with(Route::currentRouteAction(), '@create') ? 'Create' : 'Save'),
            (ends_with(Route::currentRouteAction(), '@edit') ? Html::linkAction('Admin\ProductController@delete', 'Delete', [$product->_id], ['class' => 'btn btn-danger']) : '')

        ) !!}


    {!! Former::close() !!}

@stop

@section('custom-script')
    <script>
        $('select').select2();
    </script>
@stop