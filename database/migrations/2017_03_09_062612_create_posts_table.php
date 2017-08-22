<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'posts', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('user_id')->index();
                $table->string('title');
                // slug
                $table->string('slug')->unique()->nullable();
                // 摘要
                $table->string('excerpt', 512)->nullable();
                // 文章封面
                $table->string('cover')->nullable()->comment('文章封面');
                $table->char('status', 10)->default('publish')->comment('文章状态：publish发布 draft草稿');
                // 类型
                $table->char('type', 10)->default('post')->comment('类型: post文章 page单页');
                // 浏览量
                $table->unsignedInteger('views_count')->default(0)->index();
                // 文章置顶
                $table->timestamp('top')->nullable()->index();
                $table->integer('order')->default(0)->index()->comment('排序字段');
                // 内容模板
                $table->string('template')->nullable();
                //文章的一些其他配置
                // $table->mediumText('setting')->nullable();
                $table->softDeletes();
                // 发布时间
                $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
