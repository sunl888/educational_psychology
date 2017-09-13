<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 30)->unique();
            $table->text('value');
            $table->string('description')->nullable();
            $table->char('type_name', 30)->index();
            $table->boolean('is_system')->default(false)->comment('是否为系统配置');
            $table->timestamps();
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
