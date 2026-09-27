<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMemberRequest;
use App\Models\Member;                 // ⬅️ TAMBAHAN
use Illuminate\Http\Request;

class MemberController extends Controller
{
    // ⬅️ HAPUS: private array $members = [...]  (tidak dipakai lagi)

    public function index(Request $request)
    {
        // ⬅️ UBAH: query Eloquent + search + pagination
        $search = $request->query('search');

        $members = Member::when($search, function ($query, $search) {
                return $query->where('nama', 'like', "%{$search}%");
            })
            ->paginate(10);

        return view('members.index', compact('members'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(StoreMemberRequest $request)
    {
        $validated = $request->validated();

        // ⬅️ TAMBAHAN: simpan ke DB
        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', "Anggota \"{$validated['nama']}\" berhasil ditambahkan.");
    }

    public function show(string $id)
    {
        // ⬅️ UBAH: ambil dari DB
        $member = Member::findOrFail($id);

        return view('members.show', compact('member'));
    }

    public function edit(string $id)
    {
        // ⬅️ UBAH: ambil dari DB
        $member = Member::findOrFail($id);

        return view('members.edit', compact('member'));
    }

    public function update(StoreMemberRequest $request, string $id)
    {
        // ⬅️ UBAH: logika update sungguhan
        $member = Member::findOrFail($id);

        $member->update($request->validated());

        return redirect()->route('members.index')
            ->with('success', "Anggota \"{$request->validated()['nama']}\" berhasil diperbarui.");
    }

    public function destroy(string $id)
    {
        // ⬅️ UBAH: logika delete sungguhan
        $member = Member::findOrFail($id);
        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}