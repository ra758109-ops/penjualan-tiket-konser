<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->foreignId('ticket_id')
                ->nullable()
                ->constrained('tickets_for_sale')
                ->onDelete('set null');
            $table->string('ticket_name');
            $table->string('category');
            $table->decimal('price', 15, 2);
            $table->unsignedSmallInteger('quantity');
            $table->decimal('subtotal', 15, 2);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};
