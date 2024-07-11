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
        Schema::create('supervisions', function (Blueprint $table) {
            $table->id();
            $table->date('dateSupervision');
            $table->boolean('status')->default(false);
            $table->foreignIdFor(Guide::class);
            $table->foreignIdFor(Tourist::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supervisions');
    }
};
