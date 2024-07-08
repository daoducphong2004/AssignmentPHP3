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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('img')->nullable();
            $table->text('desc')->nullable();
            $table->text('content');
            $table->integer('view')->default(0);
            $table->integer('like')->default(0);
            $table->integer('id_author');
            $table->integer('id_category');
            $table->timestamps();
            // $table->foreign('id_author')->references('id')->on('users');
            $table->foreign('id_category')->references('id')->on('category');
            
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news');
    }
};
