<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateRoutersView extends Migration
{
    public function up()
    {
        DB::statement("CREATE VIEW routerView AS
                        SELECT *
                        FROM router_details AS c");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW routerView");
    }
}
