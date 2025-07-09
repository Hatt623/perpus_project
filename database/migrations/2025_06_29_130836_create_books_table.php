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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genre_id');
            $table->string('title');
            $table->string('slug');
            $table->string('writer');
            $table->string('publisher');
            $table->string('image');
            $table->text('description');
            $table->integer('price');
            $table->integer('stock');
            $table->enum('status', ['Good', 'Bad']);

            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
