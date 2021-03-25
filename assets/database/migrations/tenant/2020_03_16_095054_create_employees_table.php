<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('marital_status_id')->nullable();
            $table->unsignedBigInteger('termination_reason_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('salutation')->nullable();
            $table->string('nickname')->nullable();
            $table->string('employee_no')->nullable()->index();
            $table->date('date_of_birth')->nullable();
            $table->string('identity_no')->nullable();
            $table->char('gender', 1)->nullable();
            $table->string('work_phone')->nullable();
            $table->string('work_phone_ext')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('work_email')->nullable();
            $table->string('personal_email')->nullable();
            $table->string('avatar')->nullable();
            $table->boolean('is_active')->default(false);
            $table->unsignedBigInteger('reports_to_id')->nullable();
            $table->integer('lft')->nullable();
            $table->integer('rgt')->nullable();
            $table->integer('depth')->nullable();
            $table->date('started_at')->nullable();
            $table->timestamp('termination_performed_at')->nullable();
            $table->timestamp('terminated_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('department_id')->references('id')->on('employee_fields')->onDelete('set null');
            $table->foreign('location_id')->references('id')->on('employee_fields')->onDelete('set null');
            $table->foreign('marital_status_id')->references('id')->on('statuses')->onDelete('set null');
            $table->foreign('termination_reason_id')->references('id')->on('employee_fields')->onDelete('set null');
            $table->foreign('reports_to_id')->references('id')->on('employees')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
}
