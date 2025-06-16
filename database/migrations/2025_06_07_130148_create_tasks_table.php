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
        Schema::create('tasks', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('taskOwner');
            $table->string('title');
            $table->string('description');
            $table->string('status');
            $table->string('deadlineDate');
            $table->string('dateCompleted')->nullable();
            $table->string('priority');
            $table->timestamps();

            $table->foreign('taskOwner')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
