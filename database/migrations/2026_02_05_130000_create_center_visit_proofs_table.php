<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('center_visit_proofs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('center_visit_evaluation_id')
                ->constrained('center_visit_evaluations')
                ->cascadeOnDelete();
            $table->json('visit_images')->nullable()->comment('Array of image paths');
            $table->decimal('visit_latitude', 10, 7)->nullable();
            $table->decimal('visit_longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('center_visit_proofs');
    }
};
