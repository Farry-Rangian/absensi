@extends('app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
</div>
<div class="container">
    <div class="row pb-3">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">Selamat Datang {{ $user->name }}</h1>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        {{ __('Logout') }}
                    </a>
                </div>
                <div class="digital_clock_wrapper p-3">
                    <div id="digit_clock_time" class="h2 text-center"></div>
                    <div id="digit_clock_date" class="h5 text-center"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
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
        <div class="col">
            <div class="card">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <h5 class="card-title">Form Absensi</h5>
                        </div>
                        <div class="container">
                            <form method="POST" id="formAbsensi" action="{{ route('home.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <div class="form-group">
                                        <h4 class="pt-3">ID ASSISTEN : {{ $user->id_assisten }}</h4>
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
                                <button type="submit" class="btn btn-primary">
                                    Clock in
                                </button>

                                <hr>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    // Memanggil currentTime() saat halaman dimuat
    $(document).ready(function() {
        currentTime();
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

    function currentTime() {
        var date = new Date(); /* creating object of Date class */
        var hour = date.getHours();
        var min = date.getMinutes();
        var sec = date.getSeconds();
        var midday = "AM";
        midday = hour >= 12 ? "PM" : "AM"; /* assigning AM/PM */
        hour = hour == 0 ? 12 : hour > 12 ? hour - 12 : hour; /* assigning hour in 12-hour format */
        hour = changeTime(hour);
        min = changeTime(min);
        sec = changeTime(sec);
        document.getElementById("digit_clock_time").innerText = hour + " : " + min + " : " + sec + " " + midday; /* adding time to the div */

        var months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        var days = ["Minggu", "senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];

        var curWeekDay = days[date.getDay()]; // get day
        var curDay = date.getDate(); // get date
        var curMonth = months[date.getMonth()]; // get month
        var curYear = date.getFullYear(); // get year
        var date = curWeekDay + ", " + curDay + " " + curMonth + " " + curYear; // get full date
        document.getElementById("digit_clock_date").innerHTML = date;

        var t = setTimeout(currentTime, 1000); /* setting timer */
    }

    function changeTime(k) {
        /* appending 0 before time elements if less than 10 */
        if (k < 10) {
            return "0" + k;
        } else {
            return k;
        }
    }

    $(document).ready(function() {
    // Memanggil currentTime() saat halaman dimuat
    currentTime();

    // Menangani submit form saat tombol "Clock in" ditekan
    $('#formAbsensi').submit(function(event) {
        // Mencegah aksi default form (pengiriman form langsung)
        event.preventDefault();

        // Lakukan AJAX untuk menyimpan data absensi ke database
        $.ajax({
            url: "{{ route('home.store') }}",
            type: 'POST',
            data: $(this).serialize(), // Menggunakan serialize untuk mengambil data formulir
            success: function(response) {
                // Jika respons berhasil, tampilkan pesan sukses sebagai alert
                alert(response.message);
                // Arahkan pengguna ke route home/show/1 setelah tombol "OK" ditekan
                window.location.href = "{{ route('home.show', ['id' => 1]) }}"; // Ganti '1' dengan id yang diinginkan
            },
            error: function(xhr, status, error) {
                // Jika respons gagal, cek pesan error dari respons JSON
                var jsonResponse = xhr.responseJSON;
                if (jsonResponse && jsonResponse.message) {
                    // Jika pesan error tersedia dalam respons JSON, gunakan pesan tersebut
                    alert('Error - ' + jsonResponse.message);
                } else {
                    // Jika tidak ada pesan error yang tersedia, tampilkan pesan default
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Error - ' + errorMessage);
                }
            }
        });
    });
});
</script>

@endsection