@extends('app')

@section('content')
<div class="container">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>ID Asisten</th>
                <th>Nama Asisten</th>
                <th>Kelas</th>
                <th>Materi</th>
                <th>Jaga Sebagai</th>
                <th>Tanggal</th>
                <th>Waktu Mulai</th>
                <th>Waktu Akhir</th>
                <th>Durasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($absensis as $absensi)
                <tr>
                    <td>{{ $absensi->user->id_assisten }}</td>
                    <td>{{ $absensi->user->name }}</td>
                    <td>{{ $absensi->kelas->nama_kelas }}</td>
                    <td>{{ $absensi->materi->nama_materi }}</td>
                    <td>{{ $absensi->teaching_role }}</td>
                    <td>{{ $absensi->date }}</td>
                    <td>{{ $absensi->start }}</td>
                    <td>{{ $absensi->end }}</td>
                    <td>{{ $absensi->duration }}</td>
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
</script>
@endsection

