<?php

use App\Models\Category;
use App\Models\DesignOption;
use App\Models\FacilityOption;
use App\Models\LocationOption;
use App\Models\PublicFacilityOption;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignIdFor(Category::class)->nullable();

            $table->float('price')->unsigned()->nullable();
            $table->float('bedroom')->unsigned()->nullable();
            $table->float('bathroom')->unsigned()->nullable();
            $table->float('land_size')->unsigned()->nullable();
            $table->foreignIdFor(PublicFacilityOption::class)->nullable();
            $table->foreignIdFor(FacilityOption::class)->nullable();
            $table->foreignIdFor(DesignOption::class)->nullable();
            $table->foreignIdFor(LocationOption::class)->nullable();
            $table->float('floors')->unsigned()->nullable();
            $table->float('building_size')->unsigned()->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
