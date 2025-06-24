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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Event Title
            $table->string('kategori'); // Event Category
            $table->text('image'); // Upload poster/image
            $table->string('link'); // Event Link to Register

            $table->date('date'); // Start Date
            $table->time('startTime'); // Start Time
            $table->time('endTime'); // End Time

            $table->string('lokasi'); // Where will your event take place

            $table->text('detail'); // Event Description

            $table->boolean('isFavorite')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
