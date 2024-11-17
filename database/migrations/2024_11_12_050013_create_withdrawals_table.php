<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('transaction_number')->unique();
            $table->decimal('amount', 15, 2); // Amount to withdraw
            $table->string('method'); // e.g., 'Bank Transfer', 'Zelle', 'PayPal', 'Crypto'

            // Bank Transfer fields
            $table->string('bank_name')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('address')->nullable();

            // Zelle specific field
            $table->string('zelle_email')->nullable();

            // PayPal specific field
            $table->string('paypal_email')->nullable();

            // Cryptocurrency-specific fields
            $table->string('wallet_address')->nullable();
            $table->string('network')->nullable();
            $table->string('coin_type')->nullable();

            $table->string('transaction_proof')->nullable();

            $table->string('status')->default('pending'); 
            $table->timestamps();
        });
    }

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdrawals');
    }
};
