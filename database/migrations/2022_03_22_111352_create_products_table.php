<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->decimal('price')->default(0);
            $table->decimal('cost')->default(0);
            $table->decimal('net')->default(0);
            $table->integer('stock_qty')->default(0);
            $table->boolean('hidden')->default(false);
            $table->foreignId('brand_id')->nullable()->constrained('brands')->nullOnDelete();
            $table->timestamp('trashed_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
