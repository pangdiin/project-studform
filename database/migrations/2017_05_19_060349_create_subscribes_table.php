<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscribesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'       )->unsigned();
            $table->integer('membership_id' )->unsigned();
            $table->datetime('start_date')->nullable();
            $table->integer('status');
            $table->integer('notified')->default(0);
            $table->timestamps();
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('membership_id')
                ->references('id')
                ->on('memberships')
                ->onDelete('cascade');
        });

        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subscribe_id')->unsigned();
            $table->float('amount');
            $table->string('email');
            $table->string('first_name');
            $table->string('last_name' );
            $table->string('payer_id'  );
            $table->string('payment_id');
            $table->timestamps();
            $table->foreign('subscribe_id')
                ->references('id')
                ->on('subscribes')
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
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('subscribes');
    }
}
