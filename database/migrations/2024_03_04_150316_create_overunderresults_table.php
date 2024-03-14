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
        Schema::create('overunderresults', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->boolean('over_half')->default(false);
            $table->boolean('over_one')->default(false);
            $table->boolean('over_two')->default(false);
            $table->boolean('over_three')->default(false);
            $table->boolean('over_four')->default(false);
            $table->boolean('over_five')->default(false);
            $table->boolean('over_six')->default(false);
            $table->boolean('under_half')->default(false);
            $table->boolean('under_one')->default(false);
            $table->boolean('under_two')->default(false);
            $table->boolean('under_three')->default(false);
            $table->boolean('under_four')->default(false);
            $table->boolean('under_five')->default(false);
            $table->boolean('under_six')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overunderresults');
    }
};
