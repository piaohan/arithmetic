<?php

namespace App\Http\Controllers;


use App\Http\Requests\sumR;
use Illuminate\Http\Request;

class TypeidController extends Controller
{
    public function store(sumR $request)
    {
        $ages = $request->only([
            'sum',
            'min',
            'max',
        ]);
        $addition = $request->get('addition', 0);
        $subtraction = $request->get('subtraction', 0);
        $multiplication = $request->get('multiplication', 0);
        $divisionMethod = $request->get('divisionMethod', 0);
        $typeid = [];
        //加法
        if ($addition) {
            array_push($typeid, "+");
        }
        //减法
        if ($subtraction) {
            array_push($typeid, '-');
        }
        //乘法
        if ($multiplication) {
            array_push($typeid, '*');
        }
        //除法
        if ($divisionMethod) {
            array_push($typeid, '/');
        }
        $arithmetics = [];
        for ($x = 0; $x <= $ages['sum']; $x++) {
            $arithmetic = $this->rule($ages['min'], $ages['max'], $typeid);
            array_push($arithmetics, $arithmetic);
        }
        return view('typeid', compact('arithmetics'));
    }

    public function rule($min, $max, $typeid)
    {
        $arithmetic = [];
        $type = array_rand($typeid, 1);
        $min = mt_rand($min, $max);
        $max = mt_rand($min, $max);
        eval("\$res=$min$typeid[$type]$max;");

        if ($typeid[$type]=='/'&&$min==0){
            $this->rule($min, $max, $typeid);
        }
        if ($res<0){
            $this->rule($min, $max, $typeid);
        }
        if ($typeid[$type]=='/'){
            $res=round($res, 2);
        }
        array_push($arithmetic, $min);
        array_push($arithmetic, $typeid[$type]);
        array_push($arithmetic, $max);
        array_push($arithmetic, $res);
        return $arithmetic;
    }
}
