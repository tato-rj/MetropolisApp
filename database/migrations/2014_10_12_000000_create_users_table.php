<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            $table->string('password');

            $table->text('card_holder_name')->nullable(); 
            $table->text('card_number')->nullable(); 
            $table->text('card_brand')->nullable();
            $table->text('card_last_four')->nullable(); 
            $table->text('cvv')->nullable(); 
            $table->text('expiry_month')->nullable(); 
            $table->text('expiry_year')->nullable(); 
            $table->text('card_holder_document_type')->nullable(); 
            $table->text('card_holder_document_value')->nullable(); 
            $table->text('address_zip')->nullable(); 
            $table->text('address_street')->nullable(); 
            $table->text('address_number')->nullable(); 
            $table->text('address_complement')->nullable(); 
            $table->text('address_district')->nullable(); 
            $table->text('address_city')->nullable(); 
            $table->text('address_state')->nullable();

            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
