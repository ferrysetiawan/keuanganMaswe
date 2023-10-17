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
        Schema::create('kolam_penjualan', function (Blueprint $table) {
            $table->unsignedBigInteger('kolam_id');
            $table->unsignedBigInteger('penjualan_id');

            $table->primary(['kolam_id','penjualan_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kolam_penjualan');
    }
};
