<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('capacity')->default(0)->nullable();
            $table->integer('occupied')->default(0)->nullable();
            $table->renameColumn('building_s_optionize', 'building_size');
            $table->dropColumn('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['capacity', 'occupied']);
            $table->renameColumn('building_size', 'building_s_optionize');
            $table->text('products')->nullable();
        });
    }
};
