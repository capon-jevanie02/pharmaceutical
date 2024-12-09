@extends('views')

@section('content')
<div class="container mt-4">
    <h2>Product List</h2>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                @if($product->image)
                <img src="{{ asset('upload/product_images/' . $product->image) }}" class="card-img-top" alt="{{ $product->name }}" style="max-height: 200px; object-fit: cover;">
                @else
                <img src="https://via.placeholder.com/150" class="card-img-top" alt="Placeholder">
                @endif
                <div class="caption card-body">
                    <h4>{{ $product->name }}</h4>
                    <p>{{ $product->description }}</p>
                    <p><strong>Price: </strong> $ {{ $product->price }}</p>
                    <a href="{{ route('add.to.cart', $product->id) }}" class="btn btn-warning btn-block text-center" role="button">Add to cart</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
