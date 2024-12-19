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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->biginteger('cat_pid')->default(0);
            $table->string('cat_name');
            $table->string('cat_slug');
            $table->string('cat_description');
            $table->string('cat_image')->nullable();
            $table->boolean('status')->default('1');
            $table->integer('flag')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
