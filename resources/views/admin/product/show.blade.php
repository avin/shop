@extends('layouts.admin')

@section('content')

    <h1>{{ $product->name }}</h1>

    <hr>

    <p>
        <strong>Category:</strong>
        @foreach($product->categories as $category)
            <a href="{!! action('Admin\CategoryController@show', [$category->_id]) !!}">{{ $category->name }}</a>;
        @endforeach
    </p>

    <p>
        <strong>Price:</strong>
        <span>{{ $product->price }} $</span>
    </p>

    <p>
        <strong>Description:</strong>
        <span>{{ $product->description }}</span>
    </p>

    <hr>

    <a class="btn btn-success" href="{!! action('Admin\ProductController@edit', [$product->_id]) !!}">
        <i class="fa fa-edit"></i> Edit
    </a>
    <a class="btn btn-default" href="{!! URL::previous() !!}">
        <i class="fa fa-arrow-left"></i> Go back
    </a>

@stop