<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Backend\Database\Migrations\MigrationHelpers;
use Modules\Backend\Entities\Receiver;

class CreateReceiversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });
        Schema::create('receivers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone_number');
            (new MigrationHelpers())->setForeignKey($table, 'identity_types', 'identity_type_id');
            (new MigrationHelpers())->setForeignKey($table, 'senders', 'sender_id');
            $table->string('code')->unique();
            $table->boolean('is_active')->default(0);
            $table->string('id_number');
            $table->enum('issued_by', array_keys(Receiver::getIssuedByArray()));
            $table->date('expiry_date')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('file')->nullable();
            (new MigrationHelpers())->setForeignKey($table, 'users', 'created_by');
            (new MigrationHelpers())->setForeignKey($table, 'users', 'updated_by', true);
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('receiver_banks', function (Blueprint $table) {
            $table->id();
            (new MigrationHelpers())->setForeignKey($table, 'banks', 'bank_id');
            (new MigrationHelpers())->setForeignKey($table, 'receivers', 'receiver_id');
            $table->string('branch');
            $table->string('account_number');
            $table->string('account_name');
            $table->boolean('is_default')->default(0);
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            (new MigrationHelpers())->setForeignKey($table, 'states', 'state_id');
            $table->string('name');
        });
//        Schema::create('municipalities', function (Blueprint $table) {
//            $table->id();
//            (new MigrationHelpers())->setForeignKey($table, 'districts', 'district_id');
//            $table->string('name');
//        });

        Schema::create('receiver_address', function (Blueprint $table) {
            $table->id();
            (new MigrationHelpers())->setForeignKey($table, 'districts', 'district_id');
            (new MigrationHelpers())->setForeignKey($table, 'receivers', 'receiver_id');
            $table->string('street')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receiver_address');
//        Schema::dropIfExists('municipalities');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('receiver_banks');
        Schema::dropIfExists('receivers');
        Schema::dropIfExists('banks');
    }
}
