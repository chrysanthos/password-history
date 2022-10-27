<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('password-history.tables.password-history.name', 'password_history'),
            static function (Blueprint $table) {
                $table->bigIncrements('id');

                $table->foreignId('user_id')
                      ->constrained(config('password-history.tables.users.name', 'users'))
                      ->cascadeOnDelete();

                $table->string('password');

                $table->unique(['user_id', 'password']);

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
        Schema::dropIfExists(config('password-history.tables.password-history.name', 'password_history'));
    }
}
