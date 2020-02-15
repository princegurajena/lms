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
            $table->bigIncrements('id');
            $table->string('emp_num')->nullable();
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('job_title')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('office_number')->nullable();

            $table->float('sick_leave',4,1)->default(0);
            $table->float('sick_leave_half_pay',4,1)->default(0);
            $table->float('sick_leave_full_pay',4,1)->default(0);
            $table->float('maternity_leave',4,1)->default(0);
            $table->float('annual_leave',4,1)->default(0);
            $table->float('study_leave',4,1)->default(0);
            $table->float('total_leave_balance',4,1)->default(0);

            $table->string('supervisor_email')->nullable();

            $table->integer('location_id')->nullable();;

            $table->boolean('profile_completed')->default(false);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('password_change_at')->nullable();
            $table->softDeletes();
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
