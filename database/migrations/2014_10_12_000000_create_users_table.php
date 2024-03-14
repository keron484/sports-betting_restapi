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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('username');
            $table->string('phone_number')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->decimal('account_balance', 8, 2)->default(100000);
            $table->decimal('bonus_acc_balance', 8, 2)->default(0);
            $table->string('avatar')->nullable();
            $table->string('country')->nullable();
            $table->string('promo_code')->nullable();
            $table->boolean('verified')->nullable();
            $table->decimal('betting_limit', 8, 2)->default(100000);
            $table->string('proveofid_image')->nullable();
            $table->integer('age')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('state')->nullable();
            $table->string('gender')->nullable();
            $table->string('address')->nullable();
            $table->string('preferred_language')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
