<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('agent_chat_evaluation', function (Blueprint $table) {
            $table->id(); // sl_no

            $table->string('project_name', 100)->nullable();
            $table->string('center_name', 100)->nullable();
            $table->string('location', 100)->nullable();
            $table->string('evaluator_name', 100)->nullable();

            $table->string('agent_id', 50);
            $table->string('agent_name', 100);

            $table->unsignedTinyInteger('communication_skills')->comment('Max 10');
            $table->unsignedTinyInteger('opening_closing')->comment('Max 10');
            $table->unsignedTinyInteger('grammar')->comment('Max 10');
            $table->unsignedTinyInteger('chat_etiquettes')->comment('Max 10');
            $table->unsignedTinyInteger('scenario_based_questions')->comment('Max 20');
            $table->unsignedTinyInteger('response_time')->comment('Max 10');
            $table->unsignedTinyInteger('crm_knowledge')->comment('Max 10');
            $table->unsignedTinyInteger('customer_handling')->comment('Max 10');
            $table->unsignedTinyInteger('quality_accuracy')->comment('Max 10');

            $table->unsignedTinyInteger('overall_score')->comment('Out of 100');
            $table->decimal('percentage', 5, 2);

            $table->text('evaluator_remarks')->nullable();

            $table->string('column001')->nullable();
            $table->string('column002')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agent_chat_evaluation');
    }
};
