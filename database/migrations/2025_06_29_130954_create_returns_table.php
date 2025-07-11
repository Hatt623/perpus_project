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
        Schema::create('returns', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lending_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');
            $table->string('lend_code');
            $table->datetime('returned_at');
            $table->integer('fines');
            $table->enum('book_status',['good','bad']);
            $table->enum('status',['pending','success']);
            $table->enum('lending_status',['borrowed','returned'])->nullable();

            $table->foreign('lending_id')->references('id')->on('lendings')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('book_id')->references('id')->on('books');

            // $table->unsignedBigInteger('lending_id');
            // $table->unsignedBigInteger('book_id');
            // $table->integer('fines');
            // $table->enum('book_status', ['Good', 'Bad']);
            // $table->enum('lending_status', ['borrowed', 'returned']);

            // $table->foreign('lending_id')->references('id')->on('lendings');
            // $table->foreign('book_id')->references('id')->on('books');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('returns');
    }
};
