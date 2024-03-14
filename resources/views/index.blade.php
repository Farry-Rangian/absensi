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
                                <button type="submit" class="btn btn-primary" onclick="tombolDua()">
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

    function tombolDua() {
    var kelas_id = document.getElementById('kelas_id').value;
    var materi_id = document.getElementById('materi_id').value;
    var teaching_role = document.getElementById('teaching_role').value;
    var code = document.getElementById('code').value;

    // Mengirim permintaan POST menggunakan Axios
    axios.post("{{ route('home.store') }}", {
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
</script>

@endsection