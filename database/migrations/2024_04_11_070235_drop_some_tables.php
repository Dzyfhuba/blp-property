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
        Schema::dropIfExists('design_options');
        Schema::dropIfExists('facility_options');
        Schema::dropIfExists('public_facility_options');
        Schema::dropIfExists('location_options');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('facility_options', function (Blueprint $table) {
            $table->id();

            $table->string('label');
            $table->integer('value');

            $table->timestamps();
        });

        Schema::create('design_options', function (Blueprint $table) {
            $table->id();

            $table->string('label');
            $table->integer('value');

            $table->timestamps();
        });

        Schema::create('location_options', function (Blueprint $table) {
            $table->id();

            $table->string('label');
            $table->integer('value');

            $table->timestamps();
        });

        Schema::create('public_facility_options', function (Blueprint $table) {
            $table->id();

            $table->string('label');
            $table->integer('value');

            $table->timestamps();
        });
    }
};
