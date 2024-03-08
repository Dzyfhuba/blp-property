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
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('bedroom', 'bedrooms');
            $table->renameColumn('bathroom', 'bathrooms');
            // $table->renameColumn('facility_id', 'facility_option_id');
            // $table->renameColumn('public_facility_id', 'public_facility_option_id');
            // $table->renameColumn('design_id', 'design_option_id');
            // $table->renameColumn('location_id', 'location_option_id');
            // $table->renameColumn('floors', 'flo_optionors');
            $table->renameColumn('building_size', 'building_s_optionize');
            $table->text('products')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->renameColumn('bedrooms', 'bedroom');
            $table->renameColumn('bathrooms', 'bathroom');
            $table->dropColumn('products');
        });
    }
};
