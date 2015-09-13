@extends('layouts.admin')

@section('content')

    @if($categories->count())
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td>
                    <a href="{!! action('Admin\CategoryController@show', [$category->_id]) !!}">
                        {{ $category->name }}
                    </a>
                </td>
                <td class="no-width">
                    <a class="btn btn-primary btn-xs" href="{!! action('Admin\CategoryController@edit', [$category->_id]) !!}">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                </td>
            </tr>
        @endforeach
        <tr></tr>
        </tbody>
    </table>
    @else
        <p class="text-muted">There still no one category</p>
    @endif

    <hr>

    <a class="btn btn-success" href="{!! action('Admin\CategoryController@create') !!}">
        <i class="fa fa-plus"></i> Add new category
    </a>

@stop