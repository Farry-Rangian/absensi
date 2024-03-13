@extends('app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
</div>
<!-- /.container-fluid -->
<div>
<form method="POST" action="{{ route('materi.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input id="nama_materi" type="text" class="form-control @error('nama_materi') is-invalid @enderror" name="nama_materi" value="{{ old('nama_materi') }}" required autocomplete="nama_materi" autofocus placeholder="Masukkan nama Materi">
            
        @error('nama_materi')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">
        Submit
    </button>
    <hr>
</form>
</div>
@endsection