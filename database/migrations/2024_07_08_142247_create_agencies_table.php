<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('agencyName');
            $table->string('agencyResponsibleName');
            $table->string('agencyAttestation')->nullable();
            $table->string('agencyAddress')->nullable();
            $table->string('agencyPhone')->nullable();
            $table->string('agencyLogo')->nullable();
            $table->integer('status')->default(0);
            $table->foreignIdFor(User::class);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
