<?php

use App\Enums\PriorityEnum;
use App\Models\User;
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
        Schema::create('errors', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->string('error_description');
            $table->string('error_steps');
            $table->foreignIdFor(User::class, 'reporter')
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->string('status')->default('new');
            $table->foreignIdFor(User::class, 'assigned_to')
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->string('priority')->default(PriorityEnum::LOW->value);
            $table->foreignIdFor(User::class, 'assigner')
                ->nullable()
                ->constrained()
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->integer('corrective_actions_to_be_done')->default(0);
            $table->integer('corrective_actions_done')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('errors');
    }
};
