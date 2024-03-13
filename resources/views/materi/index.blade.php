@extends('app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
</div>
<div class="container">

    <h1>Contoh Pop-up Alert Menggunakan SweetAlert</h1>

    <button class="btn btn-primary" onclick="contoh()">Klik disini</button>

</div>

<script type="text/javascript">

    function contoh() {

       swal({

            title: "Berhasil!",

            text: "Pop-up berhasil ditampilkan",

            icon: "success",

            button: true

        });

    }

</script>
<!-- /.container-fluid -->
<div>
</div>
@endsection