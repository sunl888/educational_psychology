<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable();
            $table->string('title')->nullable();
            $table->string('image');
            $table->char('type_name', 30)->index();
            $table->boolean('is_visible')->default(true);
            $table->unsignedInteger('creator_id')->nullable()->default(null);

            $table->boolean('is_target_blank')->default(true)->comment('链接是否在新窗口打开');
            // banner 启用时间
            $table->timestamp('enabled_at')->nullable()->comment('banner 启用时间');
            // banner 过期时间
            $table->timestamp('expired_at')->nullable()->comment('banner 过期时间');
            $table->timestamps();

            $table->foreign('creator_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('banners');
    }
}
