<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat', function (Blueprint $table) {
            $table->id();
            $table->string('pengirim', 50);
            $table->date('tgl_surat');
            $table->string('nomor_surat', 30);
            $table->string('sifat', 20)->nullable();
            $table->string('lampiran', 50)->nullable();
            $table->string('perihal', 40);
            $table->string('surat_ditujukan', 40);
            $table->string('isi_singkat', 100)->nullable();
            $table->date('tgl_terima');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('surats');
    }
}
