<?php

namespace App\Traits;

trait ModelMetadataService
{
    public static function getColumnListing($tableName)
    {
        return \DB::getSchemaBuilder()->getColumnListing($tableName);
    }
}
