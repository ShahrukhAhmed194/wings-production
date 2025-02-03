<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::post('change-switch', function (Request $request) {
    $request->validate([
        'table' => 'required',
        'column' => 'required',
        'id' => 'required'
    ]);

    $q = (array) DB::table($request->table)->find($request->id);
    if($q){
        if($q[$request->column] == 1){
            $new_val = 0;
        }else{
            $new_val = 1;
        }

        DB::table($request->table)->where('id', $request->id)->update([$request->column => $new_val]);

        return 'success';
    }

    return 'error';
})->name('changeSwitch');
