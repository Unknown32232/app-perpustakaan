<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Ambil ID member saat update, kalau ada (untuk ignore unique)
        $memberId = $this->route('member')?->id ?? $this->route('member');

        return [
            'nama'          => 'required|string|max:100',
            'nim'           => 'required|string|max:20|unique:members,nim,' . $memberId,
            'email'         => 'required|email|unique:members,email,' . $memberId,
            'nomor_telepon' => 'required|string|max:20',
            'alamat'        => 'required|string',
            'status'        => 'required|in:aktif,nonaktif',
        ];
    }
}