{{-- File: resources/views/members/show.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Anggota</title>
    <style>
        body { font-family: sans-serif; margin: 40px; max-width: 600px; }
        table { border-collapse: collapse; width: 100%; margin-top: 16px; }
        th, td { border: 1px solid #ddd; padding: 8px 12px; text-align: left; }
        th { background: #f3f4f6; width: 180px; }
        .btn { display: inline-block; margin-top: 16px; padding: 8px 16px; background: #2563eb; color: #fff; text-decoration: none; border-radius: 4px; }
    </style>
</head>
<body>
    <h1>Detail Anggota</h1>
    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar anggota</a></p>

    <table>
        <tr><th>Nama</th><td>{{ $member['nama'] }}</td></tr>
        <tr><th>NIM</th><td>{{ $member['nim'] }}</td></tr>
        <tr><th>Email</th><td>{{ $member['email'] }}</td></tr>
        <tr><th>Nomor Telepon</th><td>{{ $member['nomor_telepon'] }}</td></tr>
        <tr><th>Alamat</th><td>{{ $member['alamat'] }}</td></tr>
        <tr>
            <th>Status</th>
            <td>
                @if($member['status'] === 'aktif')
                    <span style="color: green;">Aktif</span>
                @else
                    <span style="color: #b91c1c;">Nonaktif</span>
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('members.edit', $member['id']) }}" class="btn">Edit</a>
</body>
</html>