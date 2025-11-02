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
            $table->id();//Primary post key 
            $table->foreignID('user_id')->constrained()->onDelete('cascade');//Delete posts if user is deleted
            $table->string('title');//Post title
            $table->text('body');//Posts main content
            $table->string('image_path')->nullable();// Optional path to an image
            $table->string('category')->nullable();// Catagory of the post e.g. "trip", "gear"
            $table->timestamps();
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
