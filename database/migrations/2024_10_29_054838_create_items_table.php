<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_no');
            $table->string('name');
            $table->string('inventory_location');
            $table->string('brand');
            $table->string('category');
            $table->string('stock_unit');
            $table->decimal('unit_price',8,2);
            $table->integer('supplier_id')->unsigned()->references('id')->on('suppliers');
            $table->enum('status', ['ENABLED', 'DISABLED'])->default('ENABLED');
            $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
};
