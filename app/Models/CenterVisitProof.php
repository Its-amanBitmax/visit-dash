<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CenterVisitProof extends Model
{
    use HasFactory;

    protected $fillable = [
        'center_visit_evaluation_id',
        'visit_images',
        'visit_latitude',
        'visit_longitude',
        'visit_address',
    ];

    protected $casts = [
        'visit_images' => 'array',
    ];
}
