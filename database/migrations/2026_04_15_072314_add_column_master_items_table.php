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
        Schema::table('master_items', function (Blueprint $table) {
            $table->bigInteger('category')->nullable()->after('jenis');
            $table->foreign('category')->references('id')->on('categories')->cascadeOnUpdate()->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('master_items', function (Blueprint $table) {
            $table->dropColumn(['category']);
        });
    }
};
