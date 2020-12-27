<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suburbs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('identity_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('senders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('street');
            $table->string('post_code');
            $table->string('code')->unique();
            $table->boolean('is_active')->default(0);
            $table->string('id_number')->unique();
            $table->date('expiry_date');
            $table->date('date_of_birth');
            $table->longText('file');
            $this->setForeignKey($table, 'identity_types', 'identity_type_id');
            $this->setForeignKey($table, 'countries', 'country_id');
            $this->setForeignKey($table, 'states', 'state_id');
            $this->setForeignKey($table, 'suburbs', 'suburb_id');
            $this->setForeignKey($table, 'users', 'created_by');
            $this->setForeignKey($table, 'users', 'updated_by');
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
        Schema::dropIfExists('suburbs');
        Schema::dropIfExists('states');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('identity_types');
        Schema::dropIfExists('senders');
    }

    private function setForeignKey($table, $tableName, $column)
    {
        $table->unsignedBigInteger($column);
        $table->foreign($column)
            ->references('id')
            ->on($tableName);
    }
}
