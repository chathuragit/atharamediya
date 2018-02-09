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
            $table->integer('category_id');
            $table->integer('user_id');
            $table->boolean('is_active')->default(true);
            $table->text('description');
            $table->integer('approved_by');
            $table->integer('location_id');
            $table->integer('advertisment_type_id');
            $table->string('price', '45');
            $table->string('contact_email','255');
            $table->string('contact_mobile','25');
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
