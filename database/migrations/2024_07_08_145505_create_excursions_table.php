<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Agency;
use App\Models\TourismSite;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('excursions', function (Blueprint $table) {
            $table->id();
            $table->string('excursionName');
            $table->text('excursionDescription')->nullable();
            $table->date('excursionDate');
            $table->time('excursionTime');
            $table->String('excursionPlace');
            $table->float('excursionPrice');
            $table->integer('excursionMaxParticipants');
            $table->integer('status')->default(0); 
            $table->timestamps();
            $table->softDeletes();
            $table->foreignIdFor(Agency::class);
            $table->foreignIdFor(TourismSite::class, 'tourism_site_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excursions');
    }
};
