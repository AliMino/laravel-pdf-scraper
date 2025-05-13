<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFilenameColumnToUrlScansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('url_scans', function (Blueprint $table) {
            
            $table->string('filename')
                  ->nullable()
                  ->default(null)
                  ->after('url_scan_status_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('url_scans', function (Blueprint $table) {
            //
        });
    }
}
