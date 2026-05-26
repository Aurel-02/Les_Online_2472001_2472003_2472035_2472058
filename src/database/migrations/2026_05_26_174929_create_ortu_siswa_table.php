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
        Schema::create('ortu_siswa', function (Blueprint $table) {
            $table->id();
            $table->integer('id_orangtua');
            $table->integer('id_siswa');
            $table->timestamps();

            // Foreign keys
            $table->foreign('id_orangtua')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('id_siswa')->references('id_user')->on('user')->onDelete('cascade');
            
            // Uniqueness constraint so same pair isn't duplicated
            $table->unique(['id_orangtua', 'id_siswa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ortu_siswa');
    }
};
