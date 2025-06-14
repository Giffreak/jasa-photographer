@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        {{-- Kiri: Gambar dan detail produk --}}
        <div class="col-md-6 text-white">
            <h2>Details</h2>
            @if(!empty($img))
                <img src="{{ asset('storage/' . $img) }}" alt="Image" class="img-fluid mb-3">
            @else
                <img src="{{ asset('images/nature_small_2.jpg') }}" alt="Image" class="img-fluid mb-3">
            @endif
            <h4>{{ $product->nama_products }}</h4>
            <h5 class="mb-3">Rp. {{ number_format($product->totalPrice, 0, ',', '.') }}</h5>
            <p>{{ strip_tags($product->description ?? 'Deskripsi belum tersedia.') }}</p>
        </div>

        <div class="col-md-6">
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="form-group">
                    <label class="text-white">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="text-white">Nama Pemesan</label>
                    <input type="text" name="nama_pemesan" class="form-control" required>
                </div>

                <div class="form-group">
                    <label class="text-white">No. Handphone (Whatsapp)</label>
                    <input type="text" name="no_hp" class="form-control" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="text-white">Tanggal Mulai</label>
                        <input type="date" name="day_start" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label class="text-white">Tanggal Selesai</label>
                        <input type="date" name="day_end" class="form-control" required>
                    </div>
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" name="terms" class="form-check-input" id="terms" required>
                    <label class="form-check-label text-white" for="terms">
                        Dengan ini saya menyatakan data yang saya kirim adalah benar dan dapat dipertanggungjawabkan apabila ada kesalahan data serta kesalahan dari user
                    </label>
                </div>

                <button type="submit" class="btn btn-success btn-block">Pesan</button>
            </form>
        </div>
    </div>
</div>
@endsection