@extends('layouts.admin')

@section('content')

    @if(isset($category))
        {{ Former::populate( $category ) }}
    @endif

    {!! Former::horizontal_open()
        ->secure()
        ->action(ends_with(Route::currentRouteAction(), '@create') ? action('Admin\CategoryController@store') : action('Admin\CategoryController@update', [$category->_id]))
        ->rules(['name' => 'required', 'price' => 'required', 'description' => ''])
        ->method(ends_with(Route::currentRouteAction(), '@create') ? 'POST' : 'PUT') !!}

    {!! Former::legend(ends_with(Route::currentRouteAction(), '@create') ? 'Create category' : "Edit \"{$category->name}\"") !!}

    @include('errors.list')

    {!! Former::text('name') !!}
    {!! Former::textarea('description') !!}

    <hr>

    {!! Former::actions(
            Former::large_primary_submit(ends_with(Route::currentRouteAction(), '@create') ? 'Create' : 'Save'),
            (ends_with(Route::currentRouteAction(), '@edit') ? Html::linkAction('Admin\CategoryController@delete', 'Delete', [$category->_id], ['class' => 'btn btn-danger']) : '')

        ) !!}

    {!! Former::close() !!}

@stop
