<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CenterVisitProof;

class CenterVisitEvaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'center_name',
        'location',
        'visit_date',
        'duration',
        'infrastructure_by_client',
        'remarks1',
        'system_required_by_client',
        'remarks2',
        'manpower_required_by_client',
        'remarks3',
        'evaluator_name',
        'evaluator_remarks',
    ];

    public function proofs()
    {
        return $this->hasMany(CenterVisitProof::class);
    }
}
