<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('qa_evaluation_reports', function (Blueprint $table) {

            $table->id();

            /* Basic Details */
            $table->string('name', 150);
            $table->string('employee_id', 50);
            $table->string('process_project', 150);
            $table->string('client_name', 150);
            $table->string('reporting_manager', 150);

            $table->date('evaluation_from');
            $table->date('evaluation_to');

            $table->integer('total_audits_done');
            $table->enum('audit_type', ['calls', 'chats', 'both'])->default('both');

            /* Work Performance Ratings (1–5) */
            $table->tinyInteger('audit_accuracy_rating');
            $table->text('audit_accuracy_remarks')->nullable();

            $table->tinyInteger('process_knowledge_rating');
            $table->text('process_knowledge_remarks')->nullable();

            $table->tinyInteger('compliance_sop_rating');
            $table->text('compliance_sop_remarks')->nullable();

            $table->tinyInteger('reporting_accuracy_rating');
            $table->text('reporting_accuracy_remarks')->nullable();

            $table->tinyInteger('productivity_rating');
            $table->text('productivity_remarks')->nullable();

            $table->tinyInteger('escalation_handling_rating');
            $table->text('escalation_handling_remarks')->nullable();

            $table->tinyInteger('documentation_skills_rating');
            $table->text('documentation_skills_remarks')->nullable();

            /* QA Skill Assessment */
            $table->enum('monitoring_quality', ['excellent', 'good', 'average', 'poor']);
            $table->enum('error_identification', ['excellent', 'good', 'average', 'poor']);

            $table->boolean('correct_parameter_marking');
            $table->boolean('score_calculation_accuracy');

            /* Feedback & Coaching */
            $table->enum('agent_coaching_quality', ['excellent', 'good', 'average', 'poor']);
            $table->enum('feedback_professionalism', ['excellent', 'good', 'average', 'poor']);

            $table->boolean('improvement_tracking');
            $table->boolean('repeat_error_followup');

            /* Compliance & Discipline */
            $table->boolean('attendance_adherence');
            $table->boolean('punctuality');

            $table->enum('data_confidentiality_awareness', ['strong', 'moderate', 'weak']);
            $table->enum('policy_compliance', ['strong', 'moderate', 'weak']);

            /* Observations */
            $table->text('strengths')->nullable();
            $table->text('improvement_areas')->nullable();

            /* Score Summary */
            $table->decimal('average_quality_score', 5, 2)->nullable();
            $table->integer('error_count')->nullable();
            $table->integer('critical_errors')->nullable();
            $table->integer('repeat_errors')->nullable();

            /* Final Rating */
            $table->tinyInteger('overall_rating'); // 1–5
            $table->text('final_remarks')->nullable();

            $table->string('evaluator_name', 150);
            $table->date('evaluation_date');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qa_evaluation_reports');
    }
};
