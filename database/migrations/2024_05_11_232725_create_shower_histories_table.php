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
        Schema::create('shower_histories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->unsignedBigInteger('plant_id');
            $table->unsignedBigInteger('actived_by')->nullable();
            $table->unsignedBigInteger('deactived_by')->nullable();
            $table->boolean('is_active');
            $table->boolean('is_actived_by_system');
            $table->boolean('is_deactived_by_system')->nullable();
            $table->integer('soil_before');
            $table->integer('soil_after')->nullable();
            $table->integer('temp_before');
            $table->integer('temp_after')->nullable();
            $table->integer('air_before');
            $table->integer('air_after')->nullable();
            $table->string('shower_diff')->nullable();
            $table->timestamp('shower_on');
            $table->timestamp('shower_off')->nullable();
            $table->foreign('plant_id')->references('id')->on('plants')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('actived_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('deactived_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shower_histories');
    }
};