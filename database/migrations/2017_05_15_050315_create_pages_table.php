<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->text('content');
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('thumbnail')->nullable();

            $table->text('seo')->nullable();
            $table->string('meta')->nullable();
            $table->integer('priority')->nullable();
            $table->enum('status', ['active', 'disabled']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
