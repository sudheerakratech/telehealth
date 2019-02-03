<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoomIdColumnToScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('schedule', function($table) {
            $table->bigInteger('room_id')->nullable()->default(rsql('FLOOR(1000000 + (RAND() * 8999999))'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('schedule', function($table) {
            $table->dropColumn('room_id');
        });   
    }
}
