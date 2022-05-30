<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSignaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signatures', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->timestamp('signed_at')->nullable();

            $table->string('user_id');
            $table->string('filepath');
            $table->string('filename');
            $table->string('signed_status'); // signed, open, not_agreed
            $table->string('send_to');
            $table->string('applicant');
            $table->string('text');
            $table->string('document_id');




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signatures');
    }
}
