<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompensationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compensation', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->date('effective_at')->nullable();
            $table->string('pay')->nullable();
            $table->string('rate')->nullable();
            $table->unsignedBigInteger('pay_type_id')->nullable();
            $table->unsignedBigInteger('pay_period_id')->nullable();
            $table->string('comment')->nullable();
            $table->string('currency')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
            $table->foreign('pay_type_id')->references('id')->on('employee_fields')->onDelete('set null');
            $table->foreign('pay_period_id')->references('id')->on('employee_fields')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compensation');
    }
}
