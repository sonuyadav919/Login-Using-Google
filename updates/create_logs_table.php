<?php namespace Creations\GoogleAPI\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateLogsTable extends Migration
{

    public function up()
    {
        Schema::create('creations_googleapi_logs', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('provider',  100)->nullable();
            $table->enum('result', ['successful', 'failed']);
            $table->integer('user_id')->unsigned()->nullable()->index();
            $table->string('email',  200)->nullable();
            $table->string('ip'   ,   50)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('creations_googleapi_logs');
    }

}
