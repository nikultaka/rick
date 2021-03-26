<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCorporateinformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporateinformation', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('address1');
            $table->string('address2');
            $table->string('state');
            $table->string('city');
            $table->string('vatnumber');
            $table->string('clientid');
            $table->string('weighingslipsemail');
            $table->string('storageemail');
            $table->string('invoiceemail');
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
        Schema::dropIfExists('corporateinformation');
    }
}
