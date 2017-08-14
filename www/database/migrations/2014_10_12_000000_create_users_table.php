<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            //$table->string('name');
            $table->integer('personnel_id');
            $table->string('first_name');
            $table->string('last_name');
            //$table->string('email')->unique();
            //$table->string('password');
            //$table->rememberToken();
            $table->boolean('free_of_war')->default(false);
            $table->boolean('married')->default(false);
            $table->boolean('senior')->default(false);
            $table->boolean('secretary')->default(false);
            $table->boolean('partaker')->default(false);
            $table->boolean('long_distance')->default(false);
            $table->text('extra_description')->nullable()->default(null);
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('users');
    }
}
