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
        Schema::create('paymentmethod', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('country');
            $table->string('api');
            $table->string('method_name');
            $table->boolean('status');
            $table->decimal('account_balance', 8, 2)->default(0.0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paymentmethod');
    }
};
