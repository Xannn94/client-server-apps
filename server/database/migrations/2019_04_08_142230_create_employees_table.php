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
    public function up()
    {
        /**
         * TODO: Т.к информации не много все поля в 1 таблице. Если бы было полей больше то лучше вынести в отдельную таблицу employees_info
        */
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('fio');
            $table->string('pin');
            $table->string('phone');
            $table->string('address');
            $table->integer('status');
            $table->unsignedBigInteger('department_id');
            $table->timestamps();

            $table->foreign('department_id')->references('id')->on('departments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
