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
        Schema::create('lendings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');
            $table->datetime('deadline');
            $table->enum('status',['pending','cancel','success']);
            $table->integer('qty'); // Default quantity to 1

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('book_id')->references('id')->on('books');

            $table->timestamps();
        });

        Schema::create('order_lendings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lending_id');
            $table->unsignedBigInteger('book_id');
            $table->integer('qty');

            $table->foreign('lending_id')->references('id')->on('lendings');
            $table->foreign('book_id')->references('id')->on('books');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lendings');
    }
};
