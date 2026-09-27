{{-- File: resources/views/members/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar Anggota')

@section('content')
{{-- File: resources/views/members/index.blade.php --}}
    <h1>Daftar Anggota</h1>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('members.create') }}" class="btn btn-add">+ Tambah Anggota</a>

    {{-- FORM SEARCH --}}
    <form action="{{ route('members.index') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Cari nama anggota..." value="{{ request('search') }}">
        <button type="submit">Cari</button>
        @if(request('search'))
            <a href="{{ route('members.index') }}" style="align-self:center;">Reset</a>
        @endif
    </form>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $i => $member)
                <tr>
                    <td>{{ $members->firstItem() + $i }}</td>
                    <td>{{ $member->nama }}</td>
                    <td>{{ $member->nim }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->nomor_telepon }}</td>
                    <td>{{ ucfirst($member->status) }}</td>
                    <td>
                        <a href="{{ route('members.show', $member->id) }}" class="btn btn-edit">Lihat</a>
                        <a href="{{ route('members.edit', $member->id) }}" class="btn btn-edit">Edit</a>
                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;"
                              onsubmit="return confirm('Yakin hapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-del">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" style="text-align:center;">Tidak ada data anggota.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- PAGINATION + PERTAHANKAN PARAMETER SEARCH --}}
    <div style="margin-top: 16px;">
        {{ $members->appends(request()->query())->links() }}
    </div>
@endsection