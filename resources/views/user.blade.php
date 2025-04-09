<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Pengguna</title>
</head>
<body>
    <h1>Data User</h1>

    <!-- Menampilkan Jumlah Pengguna -->
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Jumlah Pengguna</th>
        </tr>
        <tr>
            <td>{{ $jumlahPengguna }}</td>
        </tr>
    </table>
    <br>

    @if(!empty($data) && count($data) > 0) <!-- Cek apakah ada data -->
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->user_id }}</td>
            <td>{{ $d->username }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->level_id }}</td>
        </tr>
        @endforeach
    </table>
    @else
        <p>Tidak ada data pengguna.</p>
    @endif

</body>
</html>
