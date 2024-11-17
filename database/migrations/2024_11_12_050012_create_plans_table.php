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
    Schema::create('plans', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->decimal('interest', 5, 2);
        $table->string('duration'); 
        $table->decimal('min_amount', 15, 2); 
        $table->decimal('max_amount', 15, 2); 
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plans');
    }
};
