@extends('layouts/app')

@section('content')

    <div class="orderBy">
        <p>orderBy</p>
        <a href="/group/{{ $id }}/orderByName_Asc">ByNameAsc</a>
        <a href="/group/{{ $id }}/orderByName_Desc">ByNameDesc</a>
        <a href="/group/{{ $id }}/orderByPrice_Asc">ByPriceAsc</a>
        <a href="/group/{{ $id }}/orderByPrice_Desc">ByPriceDesc</a>
    </div>
    @foreach($products as $product)
        <div class="product-item">
            <p>Model: {{ $product->name }}</p>
            <p>Price: {{ $product->price }}</p>
            @if($product->discount)
                <p>Discount!!! {{ $product->discount }}</p>
                <p>Total price: {{ $product->total_price }}</p>
            @endif
            <a href="/product/{{ $product->id }}" class="btn btn-primary">Read more</a>
        </div>
    @endforeach

@endsection