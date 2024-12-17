<?php

use App\Models\Reservation;
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
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreignIdFor(Reservation::class)->nullable()->constrained()->nullOnDelete();
            $table->decimal('amount', 10, 2);
            $table->enum('network', ['TMONEY', 'FLOOZ']);
            $table->string('phone_number');
            $table->string('identifier');
            $table->timestamp('transaction_date')->useCurrent();
            $table->string('transaction_reference')->nullable();
            $table->string('currency', 3)->default('XOF');
            $table->text('transaction_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {

            $table->dropForeign(['reservation_id']); 
            $table->dropColumn([
                'reservation_id',
                'amount',
                'payment_method',
                'transaction_date',
                'transaction_reference',
                'currency',
                'transaction_details'
            ]);
        });
    }
};
