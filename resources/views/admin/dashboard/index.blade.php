@extends('layouts.admin')

@section('content')

    <div class="dow">
        <div class="col-md-6">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>
                        Elements
                    </th>
                    <th class="no-width">Count</th>
                </tr>
                </thead>
                <tr>
                    <td>
                        {{--{!! Html::linkAction('Admin\CategoriesController@index', $title = 'Categories') !!}--}}
                    </td>
                    <td>{{ $categoriesCount }}</td>
                </tr>
                <tr>
                    <td>
                        {!! Html::linkAction('Admin\ProductController@index', $title = 'Products') !!}
                    </td>
                    <td>{{ $productsCount }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">

        </div>
    </div>


@stop