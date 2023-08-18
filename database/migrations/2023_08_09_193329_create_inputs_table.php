<?php

use App\Models\Attempt;
use App\Models\Task;
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
        Schema::create('inputs', function (Blueprint $table) {
            $table->id();
            $table->string('body', 150)->nullable();
            $table->boolean('is_correct')->nullable();
            $table->foreignIdFor(Attempt::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Task::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inputs');
    }
};
