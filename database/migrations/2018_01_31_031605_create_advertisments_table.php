<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertismentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertisments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('title');
            $table->text('slug')->nullable();
            $table->integer('category_id');
            $table->integer('user_id');
            $table->boolean('is_active')->default(true);
            $table->boolean('status')->default(true);
            $table->text('description');
            $table->integer('approved_by')->default(0);
            $table->integer('location_id')->default(0);
            $table->string('price', '45')->default('0.00');
            $table->string('contact_email','255')->nullable();
            $table->string('contact_mobile','25')->nullable();
            $table->boolean('is_negotiable')->default(false);
            $table->dateTime('expier_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertisments');
    }
}
