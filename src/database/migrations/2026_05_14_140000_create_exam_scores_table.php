<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_scores', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');           // int agar cocok dengan user.id_user
            $table->string('jenis', 20);          // uts | uas | tryout
            $table->string('mapel', 100);
            $table->integer('score');             // 0–100
            $table->integer('correct');
            $table->integer('total');
            $table->longText('questions_snapshot'); // JSON: soal lengkap + jawaban benar + penjelasan
            $table->longText('student_answers');    // JSON: jawaban siswa {question_id: letter}
            $table->index('user_id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_scores');
    }
};
