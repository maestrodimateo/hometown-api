<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {

            $table->id();
            $table->string('fullname');
            $table->string('photo')->nullable();
            $table->string('status');
            $table->text('qrcode')->nullable();
            $table->foreignId('hometown_id')->constrained()->onDelete('cascade');
            $table->foreignId('status_id')->nullable()->constrained();
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
        Schema::dropIfExists('staff');
    }
}
