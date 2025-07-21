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
        Schema::create('_retrieves', function (Blueprint $table) {
            $table->id();
            $table->string('admin_name');
            $table->string('product_name');
            $table->integer('price');
            $table->integer('amount');
            $table->integer('amount_before');
            $table->integer('amount_after');
            $table->timestamps();
        });
    }    
    public function down(): void
    {
        Schema::dropIfExists('_retrieves');
    }
};
