<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Collaborators;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('processos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('collaborator_id');
            $table->foreign('collaborator_id')->references('id')->on('collaborators');
            $table->text('processo')->charset('utf8mb4');
            $table->text('descricao')->charset('utf8mb4');
            $table->text('sistemas')->charset('utf8mb4');
            $table->text('sensiveis')->charset('utf8mb4');
            $table->text('tempo')->charset('utf8mb4');
            $table->text('bases')->charset('utf8mb4')->nullable();
            $table->text('dados')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('processos');
    }
};
