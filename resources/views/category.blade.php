@extends('layouts.app')

@section('content')
  <div class="container py-5">
    <h1 class="text-center">Kategori: {{ ucfirst($slug) }}</h1>
    <p class="text-center">Menampilkan galeri berdasarkan kategori.</p>
  </div>
@endsection
@section('scripts')
  <script>
    // Tambahkan skrip khusus jika diperlukan
    console.log('Halaman Kategori telah dimuat dengan slug: {{ $slug }}');
  </script>