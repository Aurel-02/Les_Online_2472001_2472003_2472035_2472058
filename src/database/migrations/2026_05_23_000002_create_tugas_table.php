<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tugas', function (Blueprint $table) {
            $table->id('id_tugas');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->dateTime('deadline');
            $table->string('kelas');
            $table->string('mapel');
            $table->string('file_tugas')->nullable();
            $table->unsignedBigInteger('id_guru');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tugas');
    }
};
