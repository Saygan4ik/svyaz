@extends('layouts.admin')

@section('content')

    <div class="create-product-block">
        <h3>Create a new product</h3>
        {{ Form::model($product, ['method' => 'PATCH', 'action' => ['ProductController@update', $product->id]]) }}
        @include('product._create', ['textProductButton' => 'Edit the product'])
        {{ Form::close() }}
    </div>

@endsection