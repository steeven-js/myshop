<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_carriers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carrier_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            
            $table->foreign('carrier_id')
                ->references('id')
                ->on('carriers')
                ->onDelete('SET NULL');
                
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('SET NULL');
                
            $table->string('name')->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_carriers');
    }
};
