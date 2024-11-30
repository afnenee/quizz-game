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
        Schema::table('tests', function (Blueprint $table) {
            if (!Schema::hasColumn('tests', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('quiz_id');
            }
        });
    }

    public function down()
    {
        Schema::table('tests', function (Blueprint $table) {
            if (Schema::hasColumn('tests', 'category_id')) {
                $table->dropColumn('category_id');
            }
        });
    }
};
