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
            $table->id();
            $table->string('name');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('phone_number')->unique();
            $table->string('id_card_number')->unique();
            $table->string('id_card_photo');
            $table->string('npwp')->nullable();
            $table->decimal('monthly_income', 15, 2);
            $table->enum('role', ['borrower', 'lender']);
            $table->string('password');
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
