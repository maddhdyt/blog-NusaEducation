<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sidebar_settings', function (Blueprint $table) {
            $table->string('site_logo_url')->nullable()->after('id');
        });
    }

    public function down(): void
    {
        Schema::table('sidebar_settings', function (Blueprint $table) {
            $table->dropColumn('site_logo_url');
        });
    }
};
