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
        Schema::table('exam_scores', function (Blueprint $table) {
            // Raw UTBK score: +4 benar, -1 salah, 0 kosong (null untuk UTS/UAS)
            $table->integer('utbk_raw_score')->nullable()->after('total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_scores', function (Blueprint $table) {
            $table->dropColumn('utbk_raw_score');
        });
    }
};
