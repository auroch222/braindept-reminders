<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderMetaDataKeysTable extends Migration
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
        Schema::create('reminder_meta_data_keys', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('key');
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
        Schema::dropIfExists('reminder_meta_data_keys');
    }
}
