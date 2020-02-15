<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();

            $table->integer('user_id');
            $table->string('supervisor_email');

            $table->integer('type_id');

            $table->string('document_path')->nullable();
            $table->string('document_name')->nullable();
            $table->string('status')->nullable();
            $table->boolean('completed')->default(false);

            $table->softDeletes();
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
        Schema::dropIfExists('leaves');
    }
}
