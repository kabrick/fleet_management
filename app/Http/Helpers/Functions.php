<?php

use Illuminate\Support\Facades\DB;

function get_name($id, $id_column, $column, $table): string{
    $result = DB::table($table)->where($id_column, $id)->first();

    if (!$result) {
        return 'N/A';
    } else {
        return $result->$column;
    }
}
