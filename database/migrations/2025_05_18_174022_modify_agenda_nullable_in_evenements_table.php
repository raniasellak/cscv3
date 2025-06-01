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
    Schema::table('evenements', function (Blueprint $table) {
        $table->json('agenda')->nullable()->change();
    });
}

public function down()
{
    Schema::table('evenements', function (Blueprint $table) {
        $table->json('agenda')->nullable(false)->change();
    });
}

};
