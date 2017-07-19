<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('position');
            $table->integer('depth')->setDefault(1);
            $table->timestamps();
        });

        Schema::create('nodes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->integer('related_id')->nullable();
            $table->string('related_type')->nullable();
            $table->string('type')->nullable();
            $table->string('custom-id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('url')->nullable();
            $table->string('icon_font')->nullable();
            $table->string('target')->setDefault('not-self');
            $table->string('css_class')->nullable();
            $table->string('sort_order')->setDefault(0);
            $table->timestamps();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('nodes')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nodes');
        Schema::dropIfExists('menus');
    }
}
