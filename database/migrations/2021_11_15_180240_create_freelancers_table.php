<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreelancersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freelancers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('fl_id');
            $table->integer('division_id');
            $table->integer('district_id');
            $table->integer('upzilla_id');
            $table->integer('union_id');
            $table->string('village')->nullable();
            $table->string('home')->nullable();
            $table->string('profession')->nullable();
            $table->integer('income')->nullable();
            $table->string('photo')->nullable();
            $table->string('nid')->nullable();
            $table->integer('status');
            $table->integer('user_id');
            $table->integer('admin_id');
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
        Schema::dropIfExists('freelancers');
    }
}
