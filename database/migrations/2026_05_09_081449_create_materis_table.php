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
        Schema::create('materi', function (Blueprint $table) {
            $table->id('id_materi');
            $table->string('judul');
            $table->text('deskripsi')->nullable();
            $table->string('link_video')->nullable();
            $table->enum('jenjang', ['SD', 'SMP', 'SMA']);
            $table->unsignedBigInteger('id_guru');
            $table->timestamps();

            // Asumsi foreign key ke tabel user
            // $table->foreign('id_guru')->references('id_user')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
