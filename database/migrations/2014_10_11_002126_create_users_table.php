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
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('uuid', 16)->unique();
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('stripe_connect_id')->nullable();
            $table->boolean('completed_stripe_onboarding')->default(false);
            $table->string('phone')->nullable();
            $table->string('alt_phone')->nullable();
            $table->string('address')->nullable();
            $table->text('description')->nullable();
            $table->string('status', 12);
            $table->text('admin_comments')->nullable();
            $table->string('invite')->nullable();
            $table->string('stripe_customer_id')->nullable();
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
