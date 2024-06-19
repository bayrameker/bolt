<?php

namespace Core;

use Illuminate\Database\Capsule\Manager as Capsule;

class Migration
{
    public static function createProjectsTable()
    {
        Capsule::schema()->create('projects', function ($table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->timestamps();
        });
    }
}
