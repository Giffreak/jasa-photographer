@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    @foreach($products as $product)
      <div class="col-lg-4">
        <div class="image-wrap-2">
          <div class="image-info">
            <h2 class="mb-3">{{ $product->nama_products }}</h2>
            <p class="mb-2 text-[#fffff]">Rp {{ number_format($product->totalPrice, 0, ',', '.') }}</p>
            <a href="{{ route('order.create', $product->id) }}" class="btn btn-outline-white py-2 px-4">Details Package</a>          </div>
          @php
            $thumbs = is_array($product->thumbnails) ? $product->thumbnails : json_decode($product->thumbnails, true);
            $img = $thumbs[0] ?? null;
          @endphp
          @if($img && file_exists(public_path('storage/' . $img)))
            <img src="{{ asset('storage/productss' . $img) }}" alt="Image" class="img-fluid">
          @else
            <img src="{{ asset('images/nature_small_2.jpg') }}" alt="Image" class="img-fluid">
          @endif
        </div>
      </div>
    @endforeach
  </div>
</div>
@endsection