<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Backend\Database\Migrations\MigrationHelpers;
use Modules\Backend\Entities\Receiver;

class CreateSendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('name');

        });
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            (new MigrationHelpers())->setForeignKey($table, 'countries', 'country_id');
        });
        Schema::create('suburbs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('post_code');
            (new MigrationHelpers())->setForeignKey($table, 'states', 'state_id');
        });

        Schema::create('identity_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('senders', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('email');
            $table->string('code')->unique();
            $table->boolean('is_active')->default(0);
            $table->string('id_number');
            $table->date('expiry_date');
            $table->date('date_of_birth');
            $table->longText('file')->nullable();
            $table->mediumText('street');
            $table->enum('issued_by', array_keys(Receiver::getIssuedByArray()));
            (new MigrationHelpers())->setForeignKey($table, 'identity_types', 'identity_type_id');
            (new MigrationHelpers())->setForeignKey($table, 'suburbs', 'suburb_id');
            (new MigrationHelpers())->setForeignKey($table, 'users', 'created_by');
            (new MigrationHelpers())->setForeignKey($table, 'users', 'updated_by', true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function setForeignKey($table, $tableName, $column, $is_nullable = false)
    {

        if ($is_nullable) {
            $table->unsignedBigInteger($column)->nullable();
        } else {
            $table->unsignedBigInteger($column);
        }
        $table->foreign($column)
            ->references('id')
            ->on($tableName);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('senders');
        Schema::dropIfExists('suburbs');
        Schema::dropIfExists('states');
        Schema::dropIfExists('countries');
        Schema::dropIfExists('identity_types');
    }
}
