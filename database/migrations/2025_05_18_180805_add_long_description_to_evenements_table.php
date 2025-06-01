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
    Schema::table('evenements', function (Blueprint $table) {
        $table->longText('long_description')->nullable()->after('description');
    });
}

public function down(): void
{
    Schema::table('evenements', function (Blueprint $table) {
        $table->dropColumn('long_description');
    });
}

};
