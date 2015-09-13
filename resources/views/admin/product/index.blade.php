@extends('layouts.admin')

@section('content')

    @if($products->count())
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Category</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td>
                    <a href="{!! action('Admin\ProductController@show', [$product->_id]) !!}">
                        {{ $product->name }}
                    </a>
                </td>
                <td>{{ $product->price }} $</td>
                <td>
                    @foreach($product->categories as $category)
                        <a href="{!! action('Admin\CategoryController@show', [$category->_id]) !!}">{{ $category->name }}</a>;
                    @endforeach
                </td>
                <td class="no-width">
                    <a class="btn btn-primary btn-xs" href="{!! action('Admin\ProductController@edit', [$product->_id]) !!}">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </td>
            </tr>
        @endforeach
        <tr></tr>
        </tbody>
    </table>
    @else
        <p class="text-muted">There still no one product</p>
    @endif

    <hr>

    <a class="btn btn-success" href="{!! action('Admin\ProductController@create') !!}">
        <i class="fa fa-plus"></i> Add new product
    </a>

@stop