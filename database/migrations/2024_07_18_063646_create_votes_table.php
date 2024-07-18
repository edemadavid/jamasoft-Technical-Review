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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('website_id');
            $table->boolean('vote')->default(1);
            $table->timestamps();

            // Foreign key relations
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade'); // If user is deleted, delete associated votes
            $table->foreign('website_id')->references('id')->on('websites')
                ->onDelete('cascade'); // If website is deleted, delete associated votes

            // Ensures a user can vote for a website only once
            $table->unique(['user_id', 'website_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
