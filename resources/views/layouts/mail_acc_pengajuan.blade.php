<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SI-MASE</title>
    </head>
    <body>
        <h3>Pengajuan Pendaftaraan anda, pada skema {{ $skemaName }} sudah berhasil dilihat admin, status pengajuan anda adalah <b>{{ $statusAcc }}</b> <br> nantikan notifikasi terbaru.</h3>
        <a href="{{ url('/') . '/peserta/status-pengajuan/' }}"><b>Lihat Status Pengajuan</b></a>
        <br>
        <small>-- Admin <a href="url('/')">SI-MASE</a></small>
    </body>
</html>
