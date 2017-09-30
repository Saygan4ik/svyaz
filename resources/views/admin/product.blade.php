@extends('layouts.admin')

@section('content')

    <div class="product-block">
        <h3>Products</h3>
        <a href="/product">all</a>
        @foreach($groups as $group)
            <a href="/product_{{ $group->name }}">{{ $group->nameRU }}</a>
        @endforeach

        <br>
        <a href="/product/create" class="btn btn-primary">Create a new product</a>

        @foreach($products as $product)
            <div class="product-item">
                {{ Form::model($product, ['method' => 'DELETE', 'action' => ['ProductController@destroy', $product->id]]) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-warning', 'id' => 'product_delete_button']) }}
                {{ Form::close() }}
                <a href="/product/{{ $product->id }}/edit" class="btn btn-primary" id="product_edit_button">Edit</a>
                <p>Model: {{ $product->name }}</p>
                <p>Price: {{ $product->price }}</p>
                @if($product->discount)
                    <p>Discount!!! {{ $product->discount }}</p>
                    <p>Total price: {{ $product->total_price }}</p>
                @endif
            </div>
        @endforeach
    </div>

@endsection