<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipics', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->constrained('users')->onDelete('cascade'); // 关联，当删除当前用户，那么当前用户的帖子一并删除
            $table->string('title');
            $table->text('content');
            $table->text('filename')->nullable()->comment('文件名，在项目根目录markdown目录');
            $table->unsignedInteger('favour_count')->default(0)->comment('点赞数');
            $table->unsignedInteger('favorite_count')->default(0)->comment('收藏数');
            $table->boolean('recommend')->default(false)->comment('推荐');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipics');
    }
};
