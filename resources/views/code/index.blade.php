@extends('app')

@section('content')
<div class="container">
    <button class="btn btn-primary btn-block pb-3" data-toggle="modal" data-target="#exampleModal">Buat Code Baru</button>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Kode Absen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body ">
                            <div class="card-header">
                                <h5 class="card-title">Kode Absen</h5>
                            </div>
                            <div class="code-button d-flex align-items-center justify-content-center pt-3">
                                <button class="btn btn-danger mx-auto" style="width: 200px;" onclick="tombolSatu()">Generate Kode Absen</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Pembuat Kode</th>
                <th>Status Kode</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($codes as $code)
                <tr>
                    <td>{{ $code->code }}</td>
                    <td>{{ $code->user->name }}</td>
                    <td>
                        @if ( $code->id_user_get == null)
                            Belum Dipakai
                        @else
                            Sudah Dipakai
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.1/js/buttons.print.min.js"></script>

<script>
     new DataTable('#example', {
    layout: {
        topStart: {
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
        }
    }
});

function tombolSatu() {
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
@endsection

