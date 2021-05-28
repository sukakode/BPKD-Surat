<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposisisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('disposisi', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('surat_id');
            $table->foreign('surat_id')->references('id')->on('surat');

            $table->unsignedBigInteger('penginput_id');
            $table->foreign('penginput_id')->references('id')->on('users');

            $table->unsignedBigInteger('diteruskan');
            $table->foreign('diteruskan')->references('id')->on('users');

            $table->string('catatan', 100)->nullable();

            $table->smallInteger('status_penginput')->default(0);
            $table->smallInteger('status_penerima')->default(0);

            $table->bigInteger('disposisi_sebelumnya')->nullable();
            $table->string('disposisi_selanjutnya', 50)->nullable();

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
        Schema::dropIfExists('disposisi');
    }
}
