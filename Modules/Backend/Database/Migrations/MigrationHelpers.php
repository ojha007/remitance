<?php


namespace Modules\Backend\Database\Migrations;


class MigrationHelpers
{
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
}
