<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDownloadAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('download_attachments', function (Blueprint $table) {
            $table->id();
            $table->boolean('visible')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('download_attachment_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('download_attachment_id')->constrained('download_attachments')->cascadeOnDelete();
            $table->string('locale')->index();
            $table->string('title');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('download_attachment_translations');
        Schema::dropIfExists('download_attachments');
    }
}
