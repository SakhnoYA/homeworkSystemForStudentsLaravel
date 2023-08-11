<?php

use App\Models\Attempt;
use App\Models\Homework;
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
        Schema::create('attempt_homework_user', function (Blueprint $table) {
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignIdFor(Homework::class)->constrained('homeworks')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Attempt::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();

            $table->primary(['user_id', 'homework_id', 'attempt_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempt_homework_user');
    }
};
