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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name',50)->null();
            $table->string('last_name',100)->null();
            $table->unsignedBigInteger('company')->nullable();
            $table->string('email',100)->nullable();
            $table->string('phone',15)->nullable();
            $table->timestamps();

            $table->foreign('company')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
        $table->dropForeign('employees_company_foreign');
        $table->dropColumn('company');
    }
};
