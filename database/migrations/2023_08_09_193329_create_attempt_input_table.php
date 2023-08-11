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
        Schema::create('attempt_input', function (Blueprint $table) {
            $table->foreignIdFor(Attempt::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(Task::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->jsonb('user_input')->nullable();
            $table->boolean('is_correct')->nullable();

            //TODO: подумать насчет оптимальной реализации в бд

            $table->primary(['attempt_id', 'task_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attempt_input');
    }
};
