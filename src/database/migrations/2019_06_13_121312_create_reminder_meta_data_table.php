<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderMetaDataTable extends Migration
{
    public $type = "core";

    /**
     * Migration entity name
     *
     * @var string
     */
    public $entity = "";
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reminder_meta_data', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('reminder_id');
            $table->foreign('reminder_id')->references('id')->on('reminders');

            $table->unsignedBigInteger('key_id');
            $table->foreign('key_id')->references('id')->on('reminder_meta_data_keys');

            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reminder_meta_data');
    }
}
