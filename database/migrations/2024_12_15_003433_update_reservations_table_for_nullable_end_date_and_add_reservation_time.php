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
        Schema::table('reservations', function (Blueprint $table) {
            // Rendre endDate nullable
            $table->date('endDate')->nullable()->change();

            // Ajouter le champ reservationTime (nullable)
            $table->time('reservationTime')->nullable()->after('endDate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Revert endDate back to non-nullable
            $table->date('endDate')->nullable(false)->change();

            // Supprimer le champ reservationTime
            $table->dropColumn('reservationTime');
        });
    }
};
