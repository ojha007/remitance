<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Modules\Backend\Database\Migrations\MigrationHelpers;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_types', function (Blueprint $table) {
            $table->id();
            $table->text('name');
        });
        Schema::create('statuses', function (Blueprint $table) {
            $table->id();
            $table->text('name');
        });
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('code');
        });
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->date('date');
            $table->float('sending_amount');
            $table->float('receiving_amount');
            $table->float('rate');
            $table->float('charge');
            $table->text('notes')->nullable();
            $table->text('file')->nullable();
            (new MigrationHelpers())->setForeignKey($table, 'currencies', 'currency_id');
            (new MigrationHelpers())->setForeignKey($table, 'payment_types', 'payment_type_id');
            (new MigrationHelpers())->setForeignKey($table, 'receivers', 'receiver_id');
            (new MigrationHelpers())->setForeignKey($table, 'senders', 'sender_id');
            (new MigrationHelpers())->setForeignKey($table, 'users', 'updated_by', true);
            (new MigrationHelpers())->setForeignKey($table, 'receiver_banks', 'receiver_bank_id');
            (new MigrationHelpers())->setForeignKey($table, 'users', 'created_by');
            $table->timestamps();
        });
        Schema::create('transaction_status', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            (new MigrationHelpers())->setForeignKey($table, 'statuses', 'status_id');
            (new MigrationHelpers())->setForeignKey($table, 'transactions', 'transaction_id');
            (new MigrationHelpers())->setForeignKey($table, 'users', 'causer_id');
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
        Schema::dropIfExists('payment_types');
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('transaction_status');
        Schema::dropIfExists('statuses');
    }
}
