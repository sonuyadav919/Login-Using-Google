<?php namespace Creations\GoogleAPI\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateSettingsTable extends Migration
{

    public function up()
    {
        Schema::create('creations_googleapi_settings', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('creations_googleapi_settings');
    }

}
