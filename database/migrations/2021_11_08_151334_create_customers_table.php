<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
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
            $table->string('document')->nullable();
            $table->integer('lead')->default(0);
            $table->date('lead_time')->nullable();
            $table->integer('presentation')->default(0);
            $table->date('presentation_time')->nullable();
            $table->integer('sales')->default(0);
            $table->date('sales_time')->nullable();
            $table->integer('due_amount')->default(0);
            $table->integer('paid_amount')->default(0);
            $table->integer('flat')->default(0);
            $table->integer('shop')->default(0);
            $table->integer('garage')->default(0);
            $table->integer('project_id')->default(0);
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
        Schema::dropIfExists('customers');
    }
}
