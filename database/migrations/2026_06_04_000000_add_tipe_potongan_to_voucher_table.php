<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('voucher', function (Blueprint $table) {
            // Add tipe_potongan column after kode_voucher
            $table->enum('tipe_potongan', ['persentase', 'nominal'])
                  ->default('nominal')
                  ->after('kode_voucher');
        });

        // Set existing vouchers as 'nominal' by default (they already have fixed amounts)
        DB::table('voucher')->update(['tipe_potongan' => 'nominal']);
    }

    public function down(): void
    {
        Schema::table('voucher', function (Blueprint $table) {
            $table->dropColumn('tipe_potongan');
        });
    }
};
