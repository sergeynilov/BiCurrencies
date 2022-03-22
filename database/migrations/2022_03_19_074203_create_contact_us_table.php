<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_us', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->references('id')->on('users')->onDelete('CASCADE');
//            $table->integer('user_id')->unsigned();
//            $table->foreign('user_id')->references('id')->on('users')->onDelete('CASCADE');

            $table->string('title', 100);
            $table->text('content_message');

            $table->boolean('accepted')->default(false);
            $table->timestamp('accepted_at')->nullable();
            $table->foreignId('accepted_by_admin_id')->nullable()->references('id')->nullable()->on('users')->onDelete('CASCADE');

            $table->timestamp('created_at')->useCurrent();
            $table->index(['author_id','accepted'], 'contact_us_author_id_accepted_index');
        });

        Artisan::call('db:seed', array('--class' => 'contactUsWithInitData'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_us');
    }
};
