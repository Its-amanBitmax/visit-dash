<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('center_visit_proofs', function (Blueprint $table) {
            $table->text('visit_address')->nullable()->after('visit_longitude');
        });
    }

    public function down(): void
    {
        Schema::table('center_visit_proofs', function (Blueprint $table) {
            $table->dropColumn('visit_address');
        });
    }
};
