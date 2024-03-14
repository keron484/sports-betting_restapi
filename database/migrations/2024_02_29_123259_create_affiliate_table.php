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
        Schema::create('affiliate', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('username');
            $table->string('email');
            $table->string('phone');
            $table->string('country');
            $table->string('status')->default('pending');
            $table->string('first_name');
            $table->string('last_name');
            $table->integer('age');
            $table->string('address');
            $table->string('region');
            $table->string('gender');
            $table->string('rank');
            $table->string('promo_code')->nullable();
            $table->decimal('withdrawable_balance', 8, 2)->default(0.0);
            $table->decimal('monthly_withdrawalble_balance', 8, 2)->default(0.0);
            $table->string('prove_identity_image');
            $table->string('influencer_link');
            $table->string('role')->default('affiliate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('affiliate');
    }
};
