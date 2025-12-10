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
    Schema::create('tickets_for_sale', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('event_name');
        $table->string('category', 50);
        $table->string('zone', 100);
        $table->unsignedInteger('price');
        $table->unsignedSmallInteger('quantity');
        $table->string('proof_path')->nullable();
        $table->string('status', 50)->default('pending_verification');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_for_sale');
    }
};
