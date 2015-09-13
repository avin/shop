@extends('layouts.master')

@section('content')

    <h1>{{ $product->name }}
        <small>{{ $product->price }}$</small>
    </h1>

    <p>
        {{ $product->description }}
    </p>

    <p>
        <a class="btn btn-success" href="{!! action('Front\ProductController@buy', [$product->_id]) !!}">
            <i class="fa fa-edit"></i> Buy
        </a>
        <a class="btn btn-default" href="{!! action('Front\ProductController@index', ['page' => Input::get('back_page')]) !!}">
            <i class="fa fa-arrow-left"></i> Go back
        </a>
    </p>

    <hr>

    <h3>Reviews:</h3>


    @if($product->reviews->count())
        @foreach($product->reviews as $review)

            <strong>Author: </strong> {{ $review->author->first()->full_name }} <br>
            <p>{{ $review->content }}</p>

            <hr>

        @endforeach
    @else
        <p class="text-muted"> No reviews yet</p>
    @endif

    {!! Former::horizontal_open()
        ->secure()
        ->action(action('Front\ProductController@storeReview', [$product->_id]))
        ->rules(['content' => 'required'])
        ->method('POST') !!}

    @include('errors.list')

    {!! Former::textarea('content')->label('Your review') !!}

    <hr>

    {!! Former::actions()->large_primary_submit('Create review') !!}

    {!! Former::close() !!}




@stop