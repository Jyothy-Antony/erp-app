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
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('quantity');
            $table->string('packing_unit');
            $table->decimal('item_total',8,2);
            $table->decimal('discount',8,2);
            $table->decimal('net_amount',8,2);
            $table->integer('purchase_order_id')->unsigned()->references('id')->on('purchase_orders');
            $table->integer('item_id')->unsigned()->references('id')->on('items');
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
        Schema::dropIfExists('purchase_order_items');
    }
};
