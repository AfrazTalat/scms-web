<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->nullable();
            $table->string('key')->unique()->index();
            $table->text('value')->nullable();
        });
        Schema::create('setting_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('setting_id')->constrained('settings')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('translation');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('setting_translations');
        Schema::dropIfExists('settings');
    }
}
