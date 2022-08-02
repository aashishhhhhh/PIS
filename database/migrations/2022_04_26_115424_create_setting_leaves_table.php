<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_leaves', function (Blueprint $table) {
            $table->id();
            $table->string('fiscal_year');
            $table->string('leave_type');
            $table->bigInteger('home_leave');
            $table->enum('applicable_for',['पुरूष','महिला','दुबै']);
            $table->bigInteger('total_leave');
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
        Schema::dropIfExists('setting_leaves');
    }
}
