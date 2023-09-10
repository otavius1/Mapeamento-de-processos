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
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->charset('utf8mb4');
            $table->string('email')->unique()->charset('utf8mb4');
            $table->string('matricula')->unique()->charset('utf8mb4');
            $table->string('setor')->charset('utf8mb4');
            $table->string('status')->charset('utf8mb4');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collaborators');
    }
};
