<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phone_number1');
            $this->setForeignKey($table, 'identity_types', 'identity_type_id');
            $this->setForeignKey($table, 'senders', 'sender_id');
            $table->string('code')->unique();
            $table->boolean('is_active')->default(0);
            $table->string('id_number')->unique();
            $table->enum('issued_by', array_keys(Receiver::getIssuedByArray()));
            $table->string('phone_number2')->nullable();
            $table->date('expiry_date')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('file')->nullable();
            $this->setForeignKey($table, 'users', 'created_by');
            $this->setForeignKey($table, 'users', 'updated_by', true);
            $table->timestamps();
            $table->softDeletes();

        });

        Schema::create('receiver_banks', function (Blueprint $table) {
            $table->id();
            $this->setForeignKey($table, 'banks', 'bank_id');
            $this->setForeignKey($table, 'receivers', 'receiver_id');
            $table->string('branch');
            $table->string('account_number');
            $table->string('account_name');
            $table->boolean('is_default')->default(0);
        });

        Schema::create('districts', function (Blueprint $table) {
            $table->id();
            $this->setForeignKey($table, 'states', 'state_id');
            $table->string('name');
//            $table->integer('post_code');
        });
        Schema::create('municipalities', function (Blueprint $table) {
            $table->id();
            $this->setForeignKey($table, 'districts', 'district_id');
            $table->string('name');
        });
        Schema::create('receiver_address', function (Blueprint $table) {
            $table->id();
            $this->setForeignKey($table, 'districts', 'district_id');
            $this->setForeignKey($table, 'receivers', 'receiver_id');
            $table->integer('ward_number');
            $table->string('street')->nullable();
            $table->integer('tole_number')->nullable();

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
        Schema::dropIfExists('receiver_address');
        Schema::dropIfExists('municipalities');
        Schema::dropIfExists('districts');
        Schema::dropIfExists('receiver_banks');
        Schema::dropIfExists('receivers');
        Schema::dropIfExists('banks');
    }
}
