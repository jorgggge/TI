<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->bigIncrements('id');
            $table->string('firstName',255);
            $table->string('lastName',255);
            $table->string('username',255)->unique();
            $table->string('password',255);
            $table->string('email',100)->unique();
            $table->unsignedBigInteger('status')->nullable();

            $table->unsignedBigInteger('companyId')->nullable();
            $table->foreign('companyId')->references('companyId')->on('companies');

            $table->timestamp('email_verified_at')->nullable();
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
