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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();  // A unique identifier for the transaction
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->enum('status', ['pending', 'completed', 'failed']);
            $table->enum('type', ['transfer', 'withdrawal', 'investment']);
            
            // Correct the table names for foreign keys
            $table->foreignId('withdrawal_id')->nullable()->constrained('withdrawals')->onDelete('set null');
            $table->foreignId('investment_id')->nullable()->constrained('investments')->onDelete('set null');
            $table->foreignId('transfer_id')->nullable()->constrained('transfers')->onDelete('set null');
            
            $table->text('remark')->nullable();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
