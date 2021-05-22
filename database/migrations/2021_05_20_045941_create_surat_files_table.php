<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuratFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('surat_file', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('surat_id');
            $table->foreign('surat_id')->references('id')->on('surat');
            $table->string('nama_file', 30);
            $table->string('lokasi_file', 50);
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
        Schema::dropIfExists('surat_files');
    }
}
