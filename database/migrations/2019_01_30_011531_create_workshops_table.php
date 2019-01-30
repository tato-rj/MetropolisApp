<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->text('description');
            $table->string('fee');
            $table->string('reference');
            $table->string('cover_image')->nullable();
            $table->unsignedInteger('capacity')->nullable();
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->timestamps();
        });

        Schema::create('user_workshop', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('workshop_id');
            $table->string('reference')->nullable();
            $table->string('transaction_code')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->tinyInteger('status_id')->default(0);
            $table->unique(['user_id', 'workshop_id']);
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
        Schema::dropIfExists('workshops');
        Schema::dropIfExists('user_workshop');
    }
}
