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
        Schema::create('accounting_twos', function (Blueprint $table) {
            $table->id();
            $table->integer('site_id')->nullable();
            $table->string('site_name')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('gst_percentage')->nullable();
            $table->string('amount')->nullable();
            $table->string('gst_credit')->nullable();
            $table->integer('inventory')->nullable();
            $table->string('inventory_name')->nullable();
            $table->string('type')->nullable();
            $table->dateTime('accounting_date')->nullable();
            $table->string('image')->nullable();
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounting_twos');
    }
};
