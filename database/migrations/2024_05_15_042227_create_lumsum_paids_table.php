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
        Schema::create('lumsum_paids', function (Blueprint $table) {
            $table->id();
            $table->integer('dealer_id')->nullable();
            $table->string('dealer_name')->nullable();
            $table->string('bill_no')->nullable();
            $table->dateTime('paid_date')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('amount')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lumsum_paids');
    }
};
