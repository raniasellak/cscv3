<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('contacts', 'subject')) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->string('subject')->nullable()->after('email');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('contacts', 'subject')) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->dropColumn('subject');
            });
        }
    }
};
