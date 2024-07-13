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
        Schema::create('tourists', function (Blueprint $table) {
            $table->id();
            $table->string('touristName');
            $table->string('touristUserName')->nullable();
            $table->string('touristPhone')->nullable();
            $table->string('touristAddress')->nullable();
            $table->string('touristCity')->nullable();
            $table->string('touristCountry')->nullable();
            $table->string('touristPostalCode')->nullable();
            $table->string('touristPassport')->nullable();
            $table->string('touristPassportCountry')->nullable();
            $table->string('touristPassportDate')->nullable();
            $table->string('touristPassportNumber')->nullable();
            $table->string('touristPassportExpiry')->nullable();
            $table->string('touristPassportIssue')->nullable();
            $table->string('touristPassportPlace')->nullable();
            $table->string('touristPassportType')->nullable();
            $table->string('touristPassportImage')->nullable();
            $table->integer('status')->nullable();
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
        Schema::dropIfExists('tourists');
    }
};
