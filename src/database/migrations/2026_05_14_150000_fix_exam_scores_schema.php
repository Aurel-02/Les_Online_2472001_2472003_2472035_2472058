<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Drop tabel exam_scores yang skemanya salah (tidak punya user_id, dll)
        Schema::dropIfExists('exam_scores');

        // Buat ulang dengan skema lengkap
        Schema::create('exam_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');             // int agar cocok dengan user.id_user (int 11)
            $table->string('jenis', 20);            // uts | uas | tryout
            $table->string('mapel', 100);
            $table->integer('score');               // 0-100
            $table->integer('correct');
            $table->integer('total');
            $table->longText('questions_snapshot'); // JSON: soal + jawaban + penjelasan
            $table->longText('student_answers');    // JSON: jawaban siswa
            $table->index('user_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_scores');
    }
};
