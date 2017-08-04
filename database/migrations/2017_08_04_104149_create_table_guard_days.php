<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableGuardDays extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('guard_days', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('guards_number');
            $table->string('distance_type_id');
            $table->boolean('married')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('guard_days');
    }
}
