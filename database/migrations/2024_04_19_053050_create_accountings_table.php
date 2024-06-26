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
        Schema::create('accountings', function (Blueprint $table) {
            $table->id();
            $table->integer('site_id')->nullable();
            $table->string('site_name')->nullable();
            $table->string('amount')->nullable();
            $table->string('comment')->nullable();
            $table->string('image')->nullable();
            $table->string('type')->nullable();
            $table->dateTime('accounting_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accountings');
    }
};
