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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();//Primary key
            $table->foreignID('user_id')->constrained()->onDelete('cascade');//Delete comment if user is deleted
            $table->foreignID('post_id')->constrained()->onDelete('cascade');//Delete comment if post is deleted
            $table->text('body');//Content of the comment
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
