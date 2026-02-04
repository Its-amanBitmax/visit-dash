<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgentChatEvaluation extends Model
{
    use HasFactory;

    protected $table = 'agent_chat_evaluation';

    protected $fillable = [
        'project_name',
        'center_name',
        'location',
        'evaluator_name',
        'agent_id',
        'agent_name',
        'communication_skills',
        'opening_closing',
        'grammar',
        'chat_etiquettes',
        'scenario_based_questions',
        'response_time',
        'crm_knowledge',
        'customer_handling',
        'quality_accuracy',
        'overall_score',
        'percentage',
        'evaluator_remarks',
        'column001',
        'column002',
    ];
}
