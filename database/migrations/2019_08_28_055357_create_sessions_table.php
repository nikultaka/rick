<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sessions', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('user_id')->unsigned()->index('user_id_2');
			$table->string('device_id', 100);
			$table->string('device_token')->nullable();
			$table->string('device_arn')->nullable()->comment('Device ARN received from Amazon. it is used for sending Push Notification via SNS');
			$table->string('device_model', 100)->nullable();
			$table->string('platform', 10)->comment('1: Android,2:iOS,3:Web');
			$table->dateTime('login_time')->nullable();
			$table->dateTime('logout_time')->nullable();
			$table->boolean('login_status')->default(1)->comment('1: logged In, 0 logged Out');
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sessions');
	}

}
