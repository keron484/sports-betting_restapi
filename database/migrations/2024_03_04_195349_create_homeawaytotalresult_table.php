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
        Schema::create('homeawaytotalresult', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->boolean('hometotal_overhalf');
            $table->boolean('hometotal_overone');
            $table->boolean('hometotal_overtwo');
            $table->boolean('hometotal_overthree');
            $table->boolean('hometotal_overfour');
            $table->boolean('hometotal_overfive');
            $table->boolean('hometotal_oversix');
            $table->boolean('hometotal_underhalf');
            $table->boolean('hometotal_underone');
            $table->boolean('hometotal_undertwo');
            $table->boolean('hometotal_underthree');
            $table->boolean('hometotal_underfour');
            $table->boolean('hometotal_underfive');
            $table->boolean('hometotal_undersix');
            $table->boolean('awaytotal_overhalf');
            $table->boolean('awaytotal_overone');
            $table->boolean('awaytotal_overtwo');
            $table->boolean('awaytotal_overthree');
            $table->boolean('awaytotal_overfour');
            $table->boolean('awaytotal_overfive');
            $table->boolean('awaytotal_oversix');
            $table->boolean('awaytotal_underhalf');
            $table->boolean('awaytotal_underone');
            $table->boolean('awaytotal_undertwo');
            $table->boolean('awaytotal_underthree');
            $table->boolean('awaytotal_underfour');
            $table->boolean('awaytotal_underfive');
            $table->boolean('awaytotal_undersix');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('homeawaytotalresult');
    }
};
