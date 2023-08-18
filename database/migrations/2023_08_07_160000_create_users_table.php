<?php

use App\Models\UserType;
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
            $table->integer('id')->primary();
            $table->string('first_name', 30);
            $table->string('last_name', 30);
            $table->string('middle_name', 30)->nullable();
            $table->string('password', 255);
            $table->string('image')->nullable();
            $table->foreignIdFor(UserType::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->ipAddress('ip')->nullable();
            $table->boolean('is_confirmed')->default(false);
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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
