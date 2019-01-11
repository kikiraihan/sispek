<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Tabel akun/referensi
        Schema::create('akuns', function (Blueprint $table) {
            $table->increments('no_ref');
            $table->string('gol');
            $table->string('nama')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        // Tabel transaksi harian
        Schema::create('transaksis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('no_ref')->unsigned();
            // $table->smallInteger('no_ref');
            $table->date('tanggal',30);
            $table->string('keterangan',75);
            $table->integer('nominal');
            $table->string('jenis',10);
            $table->timestamps();
            $table->softDeletes();

            // belongs to akun
            $table->foreign('no_ref')->references('no_ref')->on('akuns')
                    ->onDelete('cascade')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
        Schema::dropIfExists('akuns');
    }
}
