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
        Schema::create('beritas', function (Blueprint $table) 
        {
            $table->id();
            $table->string('judul');
            $table->string('berita_detail');
            $table->string('berita_singkat');
            $table->string('nama_pembuat');
            $table->date('tgl_dibuat');
            $table->string('foto');
            $table->unsignedBigInteger('id_kategori');
            // membuat fk id_kategori yang mengacu kpd field id di table kategoris
            $table->foreign('id_kategori')->references('id')->on('kategoris')->onDelete('cascade');
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
