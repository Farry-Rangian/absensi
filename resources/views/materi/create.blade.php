@extends('app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
</div>
<!-- /.container-fluid -->
<div class="container">
    <form id="materiForm" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <input id="nama_materi" type="text" class="form-control @error('nama_materi') is-invalid @enderror" name="nama_materi" value="{{ old('nama_materi') }}" required autocomplete="nama_materi" autofocus placeholder="Masukkan nama Materi">
                
            @error('nama_materi')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <button type="button" class="btn btn-primary" onclick="submitForm()">
            Submit
        </button>
        <hr>
    </form>
</div>

<script type="text/javascript">
    function submitForm() {
    // Get form data
    var formData = new FormData($('#materiForm')[0]);

    // Perform a POST request using Axios
    axios.post("{{ route('materi.store') }}", formData)
        .then(function(response) {
            // Display success message
            swal({
                title: "Berhasil!",
                text: "Materi yang berhasil dibuat: " + response.data.materi,
                icon: "success",
                button: true
            });
        })
        .catch(function(error) {
            // Handle any errors
            console.error(error);
            // Display error message
            swal({
                title: "Oops!",
                text: "Terjadi kesalahan saat membuat materi.",
                icon: "error",
                button: true
            });
        });
}

</script>
@endsection
