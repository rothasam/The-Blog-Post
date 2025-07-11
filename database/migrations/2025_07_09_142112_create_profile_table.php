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
        Schema::create('profile', function (Blueprint $table) {
            $table->smallIncrements('profile_id');
            $table->unsignedSmallInteger('user_id');
            $table->string('username')->nullable();
            $table->string('avatar')->nullable();
            $table->string('bio')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
