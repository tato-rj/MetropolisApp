<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('reference')->nullable();
            $table->string('transaction_code')->nullable();
            $table->unsignedInteger('space_id')->default(1);
            $table->unsignedInteger('plan_id')->nullable();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('fee');
            $table->unsignedInteger('participants')->default(1);
            $table->text('emails')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->tinyInteger('status_id')->default(0);
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
        Schema::dropIfExists('events');
    }
}
