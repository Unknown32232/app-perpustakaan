{{-- File: resources/views/profil/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
    <style>
        .form-profil { max-width: 420px; }
        .form-profil label { display: block; margin-top: 12px; font-weight: bold; }
        .form-profil input { width: 100%; padding: 6px; margin-top: 4px; }
        .form-profil .error { color: #b91c1c; font-size: 14px; margin-top: 4px; }
        .info th { width: 140px; background: #f3f4f6; }
    </style>

    <h1>Profil Saya</h1>

    <table class="info">
        <tr>
            <th>Nama</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Role</th>
            <td>{{ ucfirst($user->role) }}</td>
        </tr>
    </table>

    <h2 style="margin-top: 32px;">Ganti Password</h2>

    <form action="{{ route('profil.password') }}" method="POST" class="form-profil">
        @csrf
        @method('PUT')

        <label for="password_lama">Password Lama</label>
        <input type="password" name="password_lama" id="password_lama">
        @error('password_lama')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password_baru">Password Baru</label>
        <input type="password" name="password_baru" id="password_baru">
        @error('password_baru')
            <div class="error">{{ $message }}</div>
        @enderror

        <label for="password_baru_confirmation">Konfirmasi Password Baru</label>
        <input type="password" name="password_baru_confirmation" id="password_baru_confirmation">

        <button type="submit" class="btn" style="margin-top: 20px;">Simpan Password</button>
    </form>
@endsection