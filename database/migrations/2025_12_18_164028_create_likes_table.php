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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();//Primary key
            $table->foreignID('user_id')->constrained()->onDelete('cascade');//Delete like if user is deleted
            $table->foreignID('post_id')->constrained()->onDelete('cascade');//Delete like if post is deleted
            $table->unique(['user_id', 'post_id']);//Ensure a user can like a post only once
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
