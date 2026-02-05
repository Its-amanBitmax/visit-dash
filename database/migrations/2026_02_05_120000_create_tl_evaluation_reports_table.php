<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tl_evaluation_reports', function (Blueprint $table) {
            $table->id();

            $table->string('name', 150);
            $table->string('employee_id', 50);
            $table->string('process_project', 150);
            $table->integer('team_strength');
            $table->date('evaluation_from');
            $table->date('evaluation_to');

            $table->tinyInteger('team_handling_rating');
            $table->text('team_handling_remarks')->nullable();
            $table->tinyInteger('productivity_achievement_rating');
            $table->text('productivity_achievement_remarks')->nullable();
            $table->tinyInteger('quality_improvement_rating');
            $table->text('quality_improvement_remarks')->nullable();
            $table->tinyInteger('attendance_management_rating');
            $table->text('attendance_management_remarks')->nullable();
            $table->tinyInteger('training_coaching_rating');
            $table->text('training_coaching_remarks')->nullable();
            $table->tinyInteger('escalation_handling_rating');
            $table->text('escalation_handling_remarks')->nullable();
            $table->tinyInteger('client_communication_rating');
            $table->text('client_communication_remarks')->nullable();
            $table->tinyInteger('reporting_documentation_rating');
            $table->text('reporting_documentation_remarks')->nullable();

            $table->string('kpi_aht_target', 50)->nullable();
            $table->string('kpi_aht_achieved', 50)->nullable();
            $table->enum('kpi_aht_status', ['met', 'not_met'])->nullable();
            $table->string('kpi_qa_target', 50)->nullable();
            $table->string('kpi_qa_achieved', 50)->nullable();
            $table->enum('kpi_qa_status', ['met', 'not_met'])->nullable();
            $table->string('kpi_csat_target', 50)->nullable();
            $table->string('kpi_csat_achieved', 50)->nullable();
            $table->enum('kpi_csat_status', ['met', 'not_met'])->nullable();
            $table->string('kpi_attendance_target', 50)->nullable();
            $table->string('kpi_attendance_achieved', 50)->nullable();
            $table->enum('kpi_attendance_status', ['met', 'not_met'])->nullable();
            $table->string('kpi_productivity_target', 50)->nullable();
            $table->string('kpi_productivity_achieved', 50)->nullable();
            $table->enum('kpi_productivity_status', ['met', 'not_met'])->nullable();

            $table->boolean('team_discipline_maintained');
            $table->boolean('shift_adherence');
            $table->boolean('roster_planning');
            $table->enum('attrition_control', ['strong', 'moderate', 'weak']);

            $table->boolean('regular_coaching_sessions');
            $table->boolean('training_plan_prepared');
            $table->boolean('performance_improvement_tracking');
            $table->enum('low_performer_management', ['strong', 'moderate', 'weak']);

            $table->enum('client_communication', ['excellent', 'good', 'average', 'poor']);
            $table->enum('internal_reporting', ['excellent', 'good', 'average', 'poor']);
            $table->enum('escalation_closure_speed', ['fast', 'moderate', 'slow']);
            $table->enum('coordination_with_hr', ['good', 'average', 'weak']);

            $table->text('strengths1')->nullable();
            $table->text('strengths2')->nullable();
            $table->text('strengths3')->nullable();
            $table->text('improvement1')->nullable();
            $table->text('improvement2')->nullable();
            $table->text('improvement3')->nullable();

            $table->tinyInteger('overall_rating');
            $table->text('final_remarks')->nullable();
            $table->string('evaluator_name', 150);
            $table->date('evaluation_date');

            $table->boolean('promotion_recommended');
            $table->boolean('training_required');
            $table->boolean('warning_required');
            $table->boolean('pip_recommended');
            $table->boolean('salary_revision');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tl_evaluation_reports');
    }
};
