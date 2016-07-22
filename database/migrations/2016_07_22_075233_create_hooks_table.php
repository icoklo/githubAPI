<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('github_webhooks', function (Blueprint $table) {
          $table->increments('id');
          $table->string('event_name', 100);
        //you can separate the sender, repo...etc. but let's just keep it simple
          // payload which is returned from github
          $table->text('payload');
          $table->string('repository', 100);
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
        Schema::drop('github_webhooks');
    }
}
