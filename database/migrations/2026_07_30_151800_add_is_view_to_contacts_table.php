<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsViewToContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('contacts') && !Schema::hasColumn('contacts', 'is_view')) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->tinyInteger('is_view')->default(0)->after('message');
            });
        }
        if (Schema::hasTable('contact') && !Schema::hasColumn('contact', 'is_view')) {
            Schema::table('contact', function (Blueprint $table) {
                $table->tinyInteger('is_view')->default(0)->after('message');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasTable('contacts') && Schema::hasColumn('contacts', 'is_view')) {
            Schema::table('contacts', function (Blueprint $table) {
                $table->dropColumn('is_view');
            });
        }
        if (Schema::hasTable('contact') && Schema::hasColumn('contact', 'is_view')) {
            Schema::table('contact', function (Blueprint $table) {
                $table->dropColumn('is_view');
            });
        }
    }
}
