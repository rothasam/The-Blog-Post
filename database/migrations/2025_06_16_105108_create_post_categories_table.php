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
        Schema::create('post_categories', function (Blueprint $table) {
            $table->mediumIncrements('post_category_id');
            $table->unsignedMediumInteger('post_id');
            $table->unsignedSmallInteger('category_id');
            $table->foreign('post_id')->references('post_id')->on('posts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_categories');
    }
};
