<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    private $table = 'users';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();

            $table->string('donor_id')->unique(); //уникальный ид для донора
            $table->json('donor_access'); // тут подключение к донору
            $table->json('donor_info')->nullable(); // тут информация к донору

            $table->string('sp_refresh_token', 1200)->nullable();// тут храним ререш к SP
            $table->json('sp_user_info')->nullable();// тут храним инфо о SP USER

            $table->integer('status')->default(1); //0-disable, 1-active

            $table->string('lang')->default('en');
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
        Schema::dropIfExists($this->table);
    }
}
