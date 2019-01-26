<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('plan_id');
            $table->unsignedInteger('user_id');
            $table->string('reference')->nullable();
            $table->timestamp('next_payment_at')->nullable();
            $table->timestamp('subscription_ends_at')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->string('status')->default('Aguardando confirmação');
            $table->string('card_brand')->nullable();
            $table->string('card_last_four')->nullable(); 
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
        Schema::dropIfExists('memberships');
    }
}
