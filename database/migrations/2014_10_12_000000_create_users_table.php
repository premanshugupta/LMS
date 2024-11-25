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
        Schema::create('users', function (Blueprint $table) {
            // $table->engine = 'InnoDB';
            // $table->id();
            // $table->string('name');
            // $table->string('email')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            // $table->string('password');
            // $table->enum('role', ['Teacher', 'Student']);
            // $table->json('assigned_batch_ids')->nullable(); // Store multiple Batch IDs if needed
            // $table->unsignedBigInteger('assigned_sub_batch_id')->nullable(); // Foreign Key
            // $table->rememberToken();
            // $table->timestamps();
            // $table->foreign('assigned_sub_batch_id')->references('id')->on('sub_batches')->onDelete('cascade'); 
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['Teacher', 'Student']);
            $table->json('assigned_batch_id')->nullable(); // Store multiple Batch IDs if needed
            $table->unsignedBigInteger('assigned_sub_batch_id')->nullable(); // Foreign Key
            // $table->index('assigned_sub_batch_id');
            $table->rememberToken();
            $table->timestamps();
        
            // Foreign key constraint
            // $table->foreign('assigned_sub_batch_id')->references('id')->on('sub_batches')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
