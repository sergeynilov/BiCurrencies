<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_item', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->string('key', 255)->unique();
            $table->mediumText('text');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();

            $table->index(['title'], 'cms_item_title_index');
        });

        \Artisan::call('db:seed', array('--class' => 'cmsItemWithInitData'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_item');
    }
}
