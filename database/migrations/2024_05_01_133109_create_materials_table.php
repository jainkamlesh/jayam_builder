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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('material_name')->nullable();
            $table->integer('dealer_id')->nullable();
            $table->string('dealer_name')->nullable();
            $table->string('quantity')->nullable();
            $table->string('bill_no')->nullable();
            $table->string('gadi_no')->nullable();
            $table->string('image')->nullable();
            $table->integer('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
