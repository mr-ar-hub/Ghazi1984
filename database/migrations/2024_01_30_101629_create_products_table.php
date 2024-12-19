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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('artical_name')->nullable();
            $table->longText('description');
            $table->longText('short_description')->nullable();
            $table->integer('price')->nullable();
            $table->integer('discount')->nullable();
            $table->json('size_color_map')->nullable();
            // $table->json('sizes')->nullable();
            // $table->json('colors')->nullable();
            $table->boolean('status')->default('1');
            $table->bigInteger('cat_id')->unsigned();
            $table->foreign('cat_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};