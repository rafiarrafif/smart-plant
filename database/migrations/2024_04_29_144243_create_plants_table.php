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
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('keystream');
            $table->text('notes')->nullable();
            $table->decimal('temp', 10, 2);
            $table->integer('soil');
            $table->integer('air');
            $table->string('status');
            $table->boolean('is_settings_prefer');
            $table->string('settings_type_off')->nullable();
            $table->string('settings_value_off')->nullable();
            $table->integer('settings_timer_max');
            $table->boolean('auto_shower_status');
            $table->time('auto_shower_time')->nullable();
            $table->integer('auto_shower_timer')->nullable();
            $table->boolean('trigger_shower');
            $table->boolean('callback_shower');
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamp('last_connection');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};