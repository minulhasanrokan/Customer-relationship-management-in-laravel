<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->integer('type');
            $table->string('address');
            $table->integer('flat');
            $table->integer('shop');
            $table->integer('garage');
            $table->string('photo')->nullable();
            $table->string('brochure')->nullable();
            $table->string('video')->nullable();
            $table->text('details')->nullable();

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
        Schema::dropIfExists('projects');
    }
}
