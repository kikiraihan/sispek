<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->string('nip')->unique();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('kategori');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        //kalau baganti field table..
        // Schema::table('the_table_name', function (Blueprint $table) {
        //     $table->string('hotel', 255)->change();
        // });

        // Schema::create('operator', function (Blueprint $table) {
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
