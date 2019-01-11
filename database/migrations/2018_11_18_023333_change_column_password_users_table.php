<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeColumnPasswordUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // kalau baganti field table..
        // Schema::table('users', function (Blueprint $table) {
        //     $table->string('password', 255)->change();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        // Schema::table('users', function (Blueprint $table) {
        //     $table->string('password')->change();
        // });
    }
}
