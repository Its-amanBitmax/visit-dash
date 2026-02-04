<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('center_visit_evaluations', function (Blueprint $table) {
            $table->id();

            // Basic Details
            $table->string('center_name', 150);
            $table->string('location', 150);
            $table->date('visit_date');
            $table->string('duration', 50);

            // Infrastructure
            $table->enum('infrastructure_by_client', [
                'meet',
                'not_meet',
                'need_change',
                'action_required'
            ]);

            
            

            // Remarks (after action_required)
            $table->text('remarks1')->nullable();

            // Other Requirements
            $table->enum('system_required_by_client', [
               'meet',
                'not_meet',
                'need_change',
                'action_required'
            ]);
            $table->text('remarks2')->nullable();

            $table->enum('manpower_required_by_client', [
                'meet',
                'not_meet',
                'need_change',
                'action_required'
            ]);
            $table->text('remarks3')->nullable();

            // Evaluator
            $table->string('evaluator_name', 100);
            $table->text('evaluator_remarks')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('center_visit_evaluations');
    }
};
