<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->text('title');
            $table->text('slug');
            $table->string('moto', '255');
            $table->string('logo', '25');
            $table->string('cover_image', '25');
            $table->text('description');
            $table->text('address');
            $table->string('contact_number', '25');
            $table->string('contact_email', '255');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('members');
    }
}
