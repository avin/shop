@extends('layouts.admin')

@section('content')

    <h1>{{ $category->name }}</h1>

    <hr>

    <p>
        <strong>Description:</strong>
        <span>{{ $category->description }}</span>
    </p>

    <hr>

    <a class="btn btn-success" href="{!! action('Admin\CategoryController@edit', [$category->_id]) !!}">
        <i class="fa fa-edit"></i> Edit
    </a>
    <a class="btn btn-default" href="{!! URL::previous() !!}">
        <i class="fa fa-arrow-left"></i> Go back
    </a>

@stop