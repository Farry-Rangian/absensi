@extends('app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Buat Code</h1>
    </div>
</div>
<div class="container">

    <button class="btn btn-primary" onclick="contoh()">Buat Code</button>

</div>

<script type="text/javascript">
    function contoh() {
        // Panggil AJAX untuk menyimpan code ke database
        $.ajax({
            type: "POST",
            url: "{{ route('code.store') }}",
            data: {_token: "{{ csrf_token() }}"},
            success: function(response) {
                // Tampilkan SweetAlert dengan kode yang berhasil dibuat
                swal({
                    title: "Berhasil!",
                    text: "Code yang berhasil dibuat: " + response.code,
                    icon: "success",
                    button: true
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
                // Tampilkan SweetAlert jika terjadi kesalahan
                swal({
                    title: "Oops!",
                    text: "Terjadi kesalahan saat membuat code.",
                    icon: "error",
                    button: true
                });
            }
        });
    }
    
</script>
<div>
</div>
@endsection