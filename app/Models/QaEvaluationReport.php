<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QaEvaluationReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'employee_id',
        'process_project',
        'client_name',
        'reporting_manager',
        'evaluation_from',
        'evaluation_to',
        'total_audits_done',
        'audit_type',
        'audit_accuracy_rating',
        'audit_accuracy_remarks',
        'process_knowledge_rating',
        'process_knowledge_remarks',
        'compliance_sop_rating',
        'compliance_sop_remarks',
        'reporting_accuracy_rating',
        'reporting_accuracy_remarks',
        'productivity_rating',
        'productivity_remarks',
        'escalation_handling_rating',
        'escalation_handling_remarks',
        'documentation_skills_rating',
        'documentation_skills_remarks',
        'monitoring_quality',
        'error_identification',
        'correct_parameter_marking',
        'score_calculation_accuracy',
        'agent_coaching_quality',
        'feedback_professionalism',
        'improvement_tracking',
        'repeat_error_followup',
        'attendance_adherence',
        'punctuality',
        'data_confidentiality_awareness',
        'policy_compliance',
        'strengths',
        'improvement_areas',
        'average_quality_score',
        'error_count',
        'critical_errors',
        'repeat_errors',
        'overall_rating',
        'final_remarks',
        'evaluator_name',
        'evaluation_date',
    ];
}
