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
        Schema::table('referrals', function (Blueprint $table) {
            $table->timestamp('last_bonus_at')->nullable()->after('referral_bonus');
        });
    }
    
    public function down()
    {
        Schema::table('referrals', function (Blueprint $table) {
            $table->dropColumn('last_bonus_at');
        });
    }
    
};
