<?php

namespace Core;

use Illuminate\Database\Eloquent\Model as Eloquent;

abstract class Model extends Eloquent
{
    // Ortak model işlevleri
    public static function createRecord(array $data)
    {
        return static::create($data);
    }

    public static function updateRecord($id, array $data)
    {
        $record = static::find($id);
        if ($record) {
            $record->update($data);
            return $record;
        }
        return null;
    }

    public static function deleteRecord($id)
    {
        $record = static::find($id);
        if ($record) {
            return $record->delete();
        }
        return false;
    }

    public static function findById($id)
    {
        return static::find($id);
    }

    public static function findAll()
    {
        return static::all();
    }

    public static function findByColumn($column, $value)
    {
        return static::where($column, $value)->get();
    }

    public static function findOneByColumn($column, $value)
    {
        return static::where($column, $value)->first();
    }
}
