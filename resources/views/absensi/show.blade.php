@extends('app')

@section('content')
    <div class="container-fluid">
        <!-- Konten halaman untuk "Clock Out" -->
        <!-- Tampilkan informasi sesuai kebutuhan -->
        <!-- Misalnya, tampilkan waktu mulai absensi -->
        <p>Waktu Mulai: {{ $absensi->start }}</p>

        <!-- Tambahkan formulir untuk "Clock Out" -->
        <form method="POST" id="clockOutForm" action="{{ route('home.update', ['id' => $absensi->id]) }}">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-primary">Clock Out</button>
        </form>
    </div>
@endsection
