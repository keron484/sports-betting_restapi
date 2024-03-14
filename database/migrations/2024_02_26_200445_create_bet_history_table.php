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
        Schema::create('bet_history', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->decimal('stake', 8, 2);
            $table->decimal('potential_winnings', 8, 2);
            $table->integer('num_events');
            $table->boolean('status');
            $table->json('selections');
            $table->decimal('bonus', 8, 2);
            $table->string('type');
            $table->decimal('total_odds', 8, 2);
            $table->string('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bet_history');
    }
};
