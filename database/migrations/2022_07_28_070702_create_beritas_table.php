<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('id_kategori');
            $table->string('judul');
            $table->string('desc_berita');
            $table->string('detail_berita');
            $table->string('nama_pembuat');
            $table->date('tgl_dibuat');
            $table->string('gambar');
            $table->foreign('id_kategori')->references('id')->on('kategoris')
            ->onDelete('cascade');
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
        Schema::dropIfExists('beritas');
    }
};
