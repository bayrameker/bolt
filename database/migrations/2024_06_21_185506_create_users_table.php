<?php

use Core\Migration;

class CreateUsersTable
{
    public function up()
    {
        $migration = new Migration();
        $migration->createTable('users', function ($table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });
    }
}
