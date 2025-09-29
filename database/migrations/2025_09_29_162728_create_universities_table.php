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
        Schema::create('universities', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('country_id');
            $table->unsignedInteger('city_id');
            $table->string('name');
            $table->string('cricos')->nullable();
            $table->integer('campus_count');
            $table->longText('description');
            $table->string('logo')->nullable();
            $table->string('image')->nullable();
            $table->tinyInteger('status')->default(ACTIVE_STATUS);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('universities');
    }
};
