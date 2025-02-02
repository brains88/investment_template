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
        Schema::table('investments', function (Blueprint $table) {
            $table->float('investPercentage')->default(0);
            $table->integer('remainingTime')->default(0);
        });
    }

    public function down()
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn(['investPercentage', 'remainingTime']);
        });
    }

};
