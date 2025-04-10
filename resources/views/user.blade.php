<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Pengguna</title>
</head>
<body>
    <h1>Data User</h1>
    <!-- Menampilkan Jumlah Pengguna -->
    {{-- <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Jumlah Pengguna</th>
        </tr>
        <tr>
            <td>{{ $jumlahPengguna }}</td>
        </tr>
    </table>
    <br> --}}
    
    <a href="../public/user/tambah">+ Tambah User</a>
    @if(!empty($data) && count($data) > 0) <!-- Cek apakah ada data -->
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>ID Level Pengguna</th>
            <th>Kode Level</th>
            <th>Nama Level</th>
            <th>Aksi</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->user_id }}</td>
            <td>{{ $d->username }}</td>
            <td>{{ $d->nama }}</td>
            <td>{{ $d->level_id }}</td>
            <td>{{ $d->level->level_kode }}</td>
            <td>{{ $d->level->level_nama }}</td>
            <td><a href="../public/user/ubah/{{ $d->user_id }}">Ubah</a> | <a href="../public/user/hapus/{{ $d->user_id }}">Hapus</a></td>
        </tr>
        @endforeach
    </table>
    @else
        <p>Tidak ada data pengguna.</p>
    @endif

</body>
</html>
