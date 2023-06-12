<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCarriersTable extends Migration
{
    /**
     * Run the migration.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('order_carriers');

        Schema::create('order_carriers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carrier_id');
            $table->unsignedBigInteger('order_id');
            
            $table->foreign('carrier_id')
                ->references('id')
                ->on('carriers');
                
            $table->foreign('order_id')
                ->references('id')
                ->on('orders');
                
            $table->string('name');
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_carriers');
    }
}

