<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use DB;

class ChartController extends Controller
{
    public function index(){
        $data = Account::all();
        $array[] = ['name', 'group_id'];
        foreach($data as $key => $value)
        {
        $array[++$key] = [$value->name, $value->group_id];
        }
        return view('chart')->with('group', json_encode($array));
    }
}
