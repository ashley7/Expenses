<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('incomes')) {
            Schema::create('incomes', function (Blueprint $table) {
                $table->increments('id');
                $table->timestamps();
                $table->string('date');
                $table->string('voucher_number')->nullable();          
                $table->string('phone_number')->nullable(); 
                $table->string('person_name')->nullable();
                $table->double('amount',10,2);
                $table->text('particular')->nullable();
                $table->integer('incomeaccount_id')->unsigned();
                $table->foreign('incomeaccount_id')->references('id')->on('income_accounts')->onUpdate('cascade')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('incomes');
    }
}
