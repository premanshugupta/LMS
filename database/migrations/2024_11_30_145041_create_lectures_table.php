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
        Schema::create('lectures', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('teacher_id'); // Reference to teacher
            $table->unsignedBigInteger('batch_id'); // Reference to batch
            $table->unsignedBigInteger('sub_batch_id'); // Reference to sub-batch
            $table->string('class_link')->nullable(); // Optional class link
            $table->string('video_path')->nullable(); // Path for uploaded video
            $table->timestamps(); // Created_at and updated_at timestamps

            // Foreign keys and indexing
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('sub_batch_id')->references('id')->on('sub_batches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lectures', function (Blueprint $table) {
            //
        });
    }
};
