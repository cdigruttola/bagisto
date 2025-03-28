<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_product_rental_slots', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('booking_product_id');
            $table->string('renting_type');
            $table->decimal('daily_price', 12, 4)->default(0)->nullable();
            $table->decimal('hourly_price', 12, 4)->default(0)->nullable();
            $table->boolean('same_slot_all_days')->nullable();
            $table->json('slots')->nullable();

            $table->foreign('booking_product_id')
                ->references('id')
                ->on('booking_products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_product_rental_slots');
    }
};
