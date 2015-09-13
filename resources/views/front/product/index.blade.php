@extends('layouts.master')

@section('content')

    <h1>Products</h1>

    <hr>

    <div class="text-center">
        {!! $products->appends(Request::except('page'))->render() !!}
    </div>

    @foreach($products->chunk(3) as $productsGroup)

        <div class="row">
            @foreach($productsGroup as $product)
                <div class="col-md-4">
                    <h2>{{ $product->name }} <small>{{ $product->price }}$</small></h2>

                    <p>{{ $product->description }}</p>
                    @if($product->reviews->count())
                        <p class="text-muted">Reviews: <strong>{{ $product->reviews->count() }}</strong></p>
                    @endif


                    <p>
                        <a class="btn btn-default" href="{!! action('Front\ProductController@show', [$product->_id, 'back_page' => Input::get('page')]) !!}">View details »</a>
                        <a class="btn btn-default" href="{!! action('Front\ProductController@buy', [$product->_id]) !!}">Buy</a>
                    </p>
                </div>
            @endforeach
        </div>

    @endforeach

    <div class="text-center">
        {!! $products->appends(Request::except('page'))->render() !!}
    </div>
@stop