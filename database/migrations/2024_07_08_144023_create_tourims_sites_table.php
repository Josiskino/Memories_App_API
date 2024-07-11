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
        Schema::create('tourims_sites', function (Blueprint $table) {
            $table->id();
            $table->string('tourismeSiteName');
            $table->string('tourismeSiteCity');
            $table->text('tourismeSiteDescription');
            $table->float('tourismeSiteEnterPrice');
            $table->string('tourismeSiteWebSite');
            $table->string('tourismeSitePhoneNumber');
            //longitude et latitude
            $table->timestamps();
            $table->softDeletes();
            $table->boolean('status')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourims_sites');
    }
};
