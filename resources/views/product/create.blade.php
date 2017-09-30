@extends('layouts.admin')

@section('content')

    <div class="create-product-block">
        <h3>Create a new product</h3>
        {{ Form::open(['method' => 'POST', 'action' => 'ProductController@store']) }}
        @include('product._create', ['textProductButton' => 'Create the product'])
        {{ Form::close() }}
    </div>

@endsection