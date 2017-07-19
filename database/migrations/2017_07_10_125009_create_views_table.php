<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('views', function (Blueprint $table) {
            
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->text('content')->nullable();

            $table->enum('type', ['block', 'page', 'both']);

            $table->text('seo')->nullable();
            $table->text('meta')->nullable();

            $table->string('template')->nullable();
            $table->string('row_class')->nullable();
            $table->string('row_id')->nullable();
            $table->string('item_class')->nullable();
            $table->integer('paginate')->nullable();

            $table->enum('status', ['active', 'disabled']);
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('view_contents', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('view_id')->unsigned();
            $table->string('type');

            $table->timestamps();
            $table->foreign('view_id')
                ->references('id')
                ->on('views')
                ->onDelete('cascade');

        });


        Schema::create('view_criterias', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('view_id')->unsigned();
            $table->integer('content_id')->unsigned();

            $table->integer('field');
            $table->integer('comparison');
            $table->string('condition');


            $table->timestamps();
            $table->foreign('view_id')
                ->references('id')
                ->on('views')
                ->onDelete('cascade');
            $table->foreign('content_id')
                ->references('id')
                ->on('view_contents')
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
        Schema::dropIfExists('view_criterias');
        Schema::dropIfExists('view_contents');
        Schema::dropIfExists('views');
    }
}
