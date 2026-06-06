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
        Illuminate\Support\Facades\DB::table('user')
            ->whereNull('id_jenjang')
            ->orWhere('id_jenjang', 0)
            ->update(['id_jenjang' => 3]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
