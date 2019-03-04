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
            $table->string('user_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('affiliation');
            $table->string('gender')->nullable();
            $table->string('initals')->nullable();
            $table->string('is_admin')->nullable()->default(0);
            $table->string('role_id')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('image')->nullable();
            $table->string('disable')->nullable()->default(0);
            $table->string('disable_reason')->nullable();
            $table->string('fax')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
