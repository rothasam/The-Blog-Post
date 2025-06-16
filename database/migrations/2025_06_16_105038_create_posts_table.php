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
        Schema::create('posts', function (Blueprint $table) {
            $table->mediumIncrements('post_id');
            $table->unsignedSmallInteger('user_id');
            $table->string('title');
            $table->string('description');
            $table->mediumText('content');
            $table->string('thumbnail')->nullable();
            $table->boolean('is_deleted')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
