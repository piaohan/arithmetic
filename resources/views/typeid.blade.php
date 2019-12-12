@extends('layouts.app')
@section('title')
    四则运算
@endsection
@section('content')
    <div class="row">
        <form action="">
            @foreach($arithmetics as $arit)
                <div class="col-xs-6 col-md-3">
                    <h3>{{$arit[0]}}
                        @switch($arit[1])
                            @case('+')
                            +
                            @break
                            @case('-')
                            -
                            @break
                            @case('*')
                            ×
                            @break
                            @case('/')
                            ÷
                            @break
                        @endswitch
                        {{$arit[2]}}=
{{--                        <input type="text" value="{{$arit[3]}}">--}}
                    </h3>
{{--                    {{$arit[3]}}--}}
                </div>
            @endforeach
        </form>
    </div>
@endsection
