<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('receipt_id');
            $table->string('product_id');
            $table->decimal('price_sold', 8, 2);
            $table->string('quantity');
            $table->string('served_by');
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->string('customer_location')->nullable();
            $table->string('date');
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
        Schema::dropIfExists('orders');
    }
}
