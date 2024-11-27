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
        Schema::create('batch_user', function (Blueprint $table) {
            // $table->id();
            // $table->json('batch_ids')->constrained('batches')->onDelete('cascade');
            // $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // $table->json('sub_batches_ids')->nullable();
            // $table->string('role')->after('user_id')->nullable();
            // $table->timestamps();
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('batch_id')->nullable();
            $table->unsignedBigInteger('sub_batch_id')->nullable(); // For sub-batch IDs, if applicable
            $table->string('role')->nullable();
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('batch_id')->references('id')->on('batches')->onDelete('cascade');
            $table->foreign('sub_batch_id')->references('id')->on('sub_batches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_user');
    }
};
