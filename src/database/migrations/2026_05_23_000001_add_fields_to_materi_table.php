<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->string('mapel')->nullable()->after('jenjang');
            $table->string('kelas')->nullable()->after('mapel');
            $table->string('file_materi')->nullable()->after('kelas');
        });
    }

    public function down(): void
    {
        Schema::table('materi', function (Blueprint $table) {
            $table->dropColumn(['mapel', 'kelas', 'file_materi']);
        });
    }
};
