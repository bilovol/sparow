<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomationsTable extends Migration
{

    private $table = 'automation';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('webhook_id');
            $table->integer('workflow');// 0-export, 1-post
            $table->json('meta');// book_id, post_url
            $table->json('mapping');
            $table->string('source');//user.create user.update order.create
            $table->integer('is_tracking')->default(0);
            $table->json('rule')->nullable();
            $table->integer('status');// 0-disable, 1-active
            $table->string('name');
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
