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
        Schema::table('tourims_sites', function (Blueprint $table) {
            $table->decimal('rating', 3, 2)->nullable()->default(0.00);
            $table->time('opening_time')->nullable(); 
            $table->time('closing_time')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tourims_sites', function (Blueprint $table) {
            $table->dropColumn('rating');
            $table->dropColumn('opening_time');
            $table->dropColumn('closing_time');
        });
    }
};
