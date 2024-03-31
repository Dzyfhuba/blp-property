<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('models', function (Blueprint $table) {
            $table->json('pairwise_comparison_normalized')->nullable();
            $table->json('pairwise_comparison_priority')->nullable();
            $table->json('pairwise_comparison_line_quality')->nullable();
            $table->json('pairwise_comparison_consistency_ratio')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('models', function (Blueprint $table) {
            $table->dropColumn([
                'pairwise_comparison_normalized',
                'pairwise_comparison_priority',
                'pairwise_comparison_line_quality',
                'pairwise_comparison_consistency_ratio',
            ]);
        });
    }
};
