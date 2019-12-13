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
        for ($x = 1; $x <= $ages['sum']; $x++) {
            $arithmetic = $this->rule($ages['min'], $ages['max'], $typeid);
            array_push($arithmetics, $arithmetic);
        }
        return view('typeid', compact('arithmetics'));
    }

    public function rule($min, $max, $typeid)
    {
        $arits = [];
        $arithmetic = $this->rand($min, $max, $typeid);
        $mins = $arithmetic[0];
        $types = $arithmetic[1];
        $maxs = $arithmetic[2];
        $res = $arithmetic[3];
        if ($types == '-' && $mins < $maxs) {
            return $this->rand($min, $max, $typeid);
        }

        array_push($arits, $mins);
        array_push($arits, $types);
        array_push($arits, $maxs);
        array_push($arits, $res);
        return $arits;
    }

    public function rand($min, $max, $typeid)
    {
        $arithmetic = [];
        $min = mt_rand($min, $max);
        $type = array_rand($typeid, 1);
        $max = mt_rand($min, $max);
        if ($typeid[$type] == "+") {
            $res = $min + $max;
        }
        if ($typeid[$type] == "-") {
            if ($min < $max) {
                $temp = $min;
                $min = $max;
                $max = $temp;
            }
            $res = $min - $max;
        }
        if ($typeid[$type] == "*") {
            $res = $min * $max;
        }
        if ($typeid[$type] == "/") {
            if ($min == 0) {
                $min = round(mt_rand($min + 1, $max), 2);
            }
            $res = $min / $max;
        }
        array_push($arithmetic, $min);
        array_push($arithmetic, $typeid[$type]);
        array_push($arithmetic, $max);
        array_push($arithmetic, $res);
        return $arithmetic;
    }
}
