<!DOCTYPE html>
<html lang="en">
<head>
    <title>Data Pengguna</title>
</head>
<body>
    <h1>Data Pengguna</h1>
    <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
        @foreach ($data as $d)
        <tr>
            <td>{{ $d->user_id }}</td> <!-- Sesuai dengan database -->
            <td>{{ $d->nama }}</td> <!-- Sesuai dengan database -->
            <td>{{ $d->username }}</td> <!-- Menggunakan 'username' dari database -->
        </tr>
        @endforeach
    </table>
</body>
</html>
