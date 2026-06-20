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
        Schema::table('settings', function (Blueprint $table) {
            $table->string('bank_name')->nullable()->after('tiktok');
            $table->string('account_number')->nullable()->after('bank_name');
            $table->string('swift_bic_code')->nullable()->after('account_number');
            $table->string('beneficiary')->nullable()->after('swift_bic_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['bank_name', 'account_number', 'swift_bic_code', 'beneficiary']);
        });
    }
};
