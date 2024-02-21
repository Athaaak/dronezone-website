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
        Schema::create('providers', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('provider_email')->nullable();
            $table->string('division')->nullable();
            $table->string('address_provider')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('contact')->nullable();
            $table->text('description')->nullable();
            $table->string('district')->nullable();
            $table->text('photo')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
