@extends('app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>
</div>
<div class="container">

    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <div class="card-header">
                <h5 class="card-title">Buat Code Absen</h5>
            </div>
            
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
        </div>
      </div>

    <button class="btn btn-primary" onclick="contoh()">Buat Code</button>

    <div class="digital_clock_wrapper">
        <div id="digit_clock_time"></div>
        <div id="digit_clock_date"></div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">
    // Memanggil currentTime() saat halaman dimuat
    $(document).ready(function() {
        currentTime();
    });

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