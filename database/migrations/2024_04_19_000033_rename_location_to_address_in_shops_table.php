<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameLocationToAddressInShopsTable extends Migration
{
    public function up()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->renameColumn('location', 'address');
        });
    }

    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            $table->renameColumn('address', 'location');
        });
    }
}
