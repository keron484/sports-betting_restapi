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
        Schema::create('match_winner_result', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->boolean('hometeam_win');
            $table->boolean('awayteam_win');
            $table->boolean('draw');
            $table->boolean('home_doublechance');
            $table->boolean('away_doublechance');
            $table->boolean('home_or_away');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_winner_result');
    }
};
