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
            $table->text('title')->nullable();
            $table->text('slug')->nullable();
            $table->string('moto', '255')->nullable();
            $table->string('logo', '25')->nullable();
            $table->string('cover_image', '25')->nullable();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->string('contact_number', '25')->nullable();
            $table->string('contact_email', '255')->nullable();
            $table->string('corporate_color_forground', '8')->nullable();
            $table->string('corporate_color_background', '8')->nullable();
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
