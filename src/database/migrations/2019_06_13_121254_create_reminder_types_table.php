<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReminderTypesTable extends Migration
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
        Schema::create('reminder_types', function (Blueprint $table) {
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
        Schema::dropIfExists('reminder_types');
    }
}
