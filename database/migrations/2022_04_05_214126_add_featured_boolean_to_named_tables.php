<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeaturedBooleanToNamedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->boolean('featured')->default(false)->index();
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->boolean('featured')->default(false)->index();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('featured')->default(false)->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('featured');
        });
        Schema::table('categories', function (Blueprint $table) {
            $table->dropColumn('featured');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('featured');
        });
    }
}
