<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_group', function (Blueprint $table) {
            // tu mi zapravo ne treba ovaj id, nego bi se trebal sloziti dvokomponentni primarni kljuc koji
            // bi se sastojal od user_id i group_id
            // ili ako koristis id kao primarni kljuc tada treba staviti da su user_id ili group_id unique
            // tako da se ne desi da korisnik moze biti u dvije iste grupe i da se to sprema u bazu
            // npr da se sprijeci ovaj zapis u tablici user_group: (id,user_id,group_id)
            // 1 1 1
            // 5 1 1
            // 6 1 1
            // jer je prema tome korisnik sa id 1 triput zapisan u grupu sa id 1 sto je glupo rjesenje

            $table->increments('id');
            $table->bigInteger('user_id');
            $table->bigInteger('group_id');
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
        //
    }
}
