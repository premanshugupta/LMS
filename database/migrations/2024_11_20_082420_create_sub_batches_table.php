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
        Schema::create('sub_batches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('flag')->default(1); // Active by default
            $table->unsignedBigInteger('batch_id'); // Foreign key to batches
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade'); // Cascade delete
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_batches');
    }
};
