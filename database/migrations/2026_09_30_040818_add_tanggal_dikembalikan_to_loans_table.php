<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Kolom ini sudah ada di create_loans_table, jadi hanya ditambah kalau belum ada
        // (supaya migrate:fresh tidak error "Duplicate column").
        if (! Schema::hasColumn('loans', 'tanggal_dikembalikan')) {
            Schema::table('loans', function (Blueprint $table) {
                $table->date('tanggal_dikembalikan')->nullable()->after('tanggal_kembali');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Dibiarkan kosong: kolom ini dimiliki oleh create_loans_table.
    }
};