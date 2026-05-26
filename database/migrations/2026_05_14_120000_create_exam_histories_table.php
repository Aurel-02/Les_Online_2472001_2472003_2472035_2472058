<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('jenis', 20);   // uts, uas, tryout
            $table->string('mapel', 100);
            $table->integer('score');       // 0 - 100
            $table->integer('correct');     // jumlah jawaban benar
            $table->integer('total');       // total soal
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_histories');
    }
};
