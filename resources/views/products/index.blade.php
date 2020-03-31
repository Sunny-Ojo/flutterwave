@extends('layouts.products')
@section('title', 'Products listing |  Welcome')

@section('content')
@if (count($products)> 0 )
@foreach ($products as $product)


<div class="col-lg-4 col-md-6 mb-4">
    <div class="card h-100">
    <a href="/products/{{$product->id}}"
            ><img
                class="card-img-top"
    src="/storage/images/{{ $product->image}}"
                alt="product image"
         style=""/></a>
        <hr>
        {{-- <div class="card-body"> --}}
            <h4 class="card-title ml-2">
            <a href="/products/{{ $product->id}}"> {{ $product->name   }}</a>
            </h4>
            <small class="ml-2"><b>{{ $product->prize }}</b></small>
            {{-- <p class="card-text">
            {{ substr(  $product->about,0, 40 ), }} <a href="/products/{{$product->id}}">....more</a>
            </p> --}}
        {{-- </div> --}}
        {{-- <div class="card-footer"> --}}
            <small class="ml-2 mb-1 text-dark">
              @if ($product->rating == 4)
              &#9733; &#9733; &#9733; &#9733;
              &#9734;
              @elseif ($product->rating == 3)
              &#9733; &#9733; &#9733; &#9734;
              &#9734;
              @elseif ($product->rating == 2)
              &#9733; &#9733; &#9734; &#9734;
              &#9734;
              @elseif ($product->rating == 1)
              &#9733; &#9734; &#9734; &#9734;
              &#9734;
              @else
              &#9733; &#9733; &#9733; &#9733;
              &#9733;
              @endif
            </small
            >
        </div>
    </div>
{{-- </div> --}}

@endforeach
{{ $products->links() }}
@else
<div class="container">
    <h4 class="text-danger">There are no products at the moment!!!  <a href="/products/create" class="btn btn-warning">Add products?</a></h4>

    </div>

@endif

@endsection
