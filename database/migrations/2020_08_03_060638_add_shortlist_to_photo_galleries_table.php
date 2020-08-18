<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShortlistToPhotoGalleriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('photo_galleries', function (Blueprint $table) {
            $table->boolean('shortlist')->after('file_source')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('photo_galleries', function (Blueprint $table) {
            $table->dropColumn('shortlist');
        });
    }
}
