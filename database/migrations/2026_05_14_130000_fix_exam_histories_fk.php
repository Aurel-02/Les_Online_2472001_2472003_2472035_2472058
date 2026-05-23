<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop tabel lama
        Schema::dropIfExists('exam_histories');

        // Buat ulang — tanpa FK constraint karena tabel 'user' memakai int(11) signed
        // sehingga tidak kompatibel dengan unsignedBigInteger Laravel default.
        // Kita pakai integer biasa agar tetap bisa disimpan.
        Schema::create('exam_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');   // int(11) agar cocok dengan user.id_user
            $table->string('jenis', 20);
            $table->string('mapel', 100);
            $table->integer('score');
            $table->integer('correct');
            $table->integer('total');
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_histories');
    }
};
