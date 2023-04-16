<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('post_tag', function (Blueprint $table) {
            $table->renameColumn('post_id', 'project_id');
        });
        Schema::rename('post_tag', 'project_tag');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('project_tag', 'post_tag');
        Schema::table('post_tag', function (Blueprint $table) {
            $table->renameColumn('project_id', 'post_id');
        });
    }
}
