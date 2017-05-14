<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
        public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('team_id')->nullable()->default(null);
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable()->default("");
            $table->string('dob');
            $table->integer('sex')->default(1);
            $table->string('department');
            $table->string('semester');
            $table->string('reg_no');
            $table->string('media_id')->nullable()->default("");
            $table->integer('status');
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
        Schema::dropIfExists('members');
    }
}
