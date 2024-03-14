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
        Schema::create('accumulator_bonus', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->decimal('min_odds', 3, 2);
            $table->integer('bonus_percentage');
            $table->boolean('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accumulator_bonus');
    }
};
