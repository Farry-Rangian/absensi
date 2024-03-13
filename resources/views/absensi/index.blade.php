@extends('app')

@section('content')
<div class="container-fluid">

    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Absensi</h1>
        </div>
    </div>
</div>
<div class="container">
    <form method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <div class="form-group">
                <label for="id_assisten">ID ASSISTEN : {{ $user->id_assisten }}</label>
                <input class="form-control" type="text" value="{{ $user->id }}" hidden>
                @error('code_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            @error('code_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <select id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" name="kelas_id" required>
                <option value="">Pilih Kelas</option>
                @foreach($kelas as $kelasItem)
                    <option value="{{ $kelasItem->id }}">{{ $kelasItem->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select id="materi_id" class="form-control @error('materi_id') is-invalid @enderror" name="materi_id" required>
                <option value="">Pilih materi</option>
                @foreach($materi as $materiItem)
                    <option value="{{ $materiItem->id }}">{{ $materiItem->nama_materi }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <select id="teaching_role" class="form-control @error('teaching_role') is-invalid @enderror" name="teaching_role" required autocomplete="teaching_role" autofocus>
                <option value="" disabled selected>Peran Jaga</option>
                <option value="Tutor" {{ old('teaching_role') == 'Tutor' ? 'selected' : '' }}>Tutor</option>
                <option value="Asissten" {{ old('teaching_role') == 'Assisten' ? 'selected' : '' }}>Assisten</option>
                <option value="Ketua" {{ old('teaching_role') == 'Ketua' ? 'selected' : '' }}>Ketua</option>
            </select>
            @error('teaching_role')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group">
            <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus placeholder="Masukkan code absen">
                
            @error('code')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" onclick="tombol()">
            Submit
        </button>
        <hr>
    </form>

</div>

<script type="text/javascript">

function tombol() {
    var kelas_id = document.getElementById('kelas_id').value;
    var materi_id = document.getElementById('materi_id').value;
    var teaching_role = document.getElementById('teaching_role').value;
    var code = document.getElementById('code').value;

    // Mengirim permintaan POST menggunakan Axios
    axios.post("{{ route('absensi.store') }}", {
            _token: "{{ csrf_token() }}", // Menambahkan nilai kode absen ke dalam payload data
            kelas_id: kelas_id,
            materi_id: materi_id,
            teaching_role: teaching_role,
            code: code
        })
        .then(function(response) {
            // Menangani respons jika berhasil
            swal({
                title: "Berhasil!",
                text: "Absen berhasil",
                icon: "success",
                button: true
            });
        })
        .catch(function(error) {
            console.error(error);
            swal({
                title: "Oops!",
                text: "Kode Absen Invalid",
                icon: "error",
                button: true
            });
        });
    
}
</script>
<!-- /.container-fluid -->
<div>
</div>
@endsection