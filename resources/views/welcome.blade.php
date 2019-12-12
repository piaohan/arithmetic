@extends('layouts.app')
@section('title')
    首页
@endsection
@section('content')
    <h3>浩浩的四则运算专用题目生成器</h3>
    <div style="padding: 20px"></div>
    @if(count($errors)>0)
        <p style="color:red">{{$errors->first()}}</p>
    @endif
    <form method="POST" action="/typeid">
        @csrf
        <div class="form-group">
            <label for="sum">需要生成的题目数量(范围:1-100) @component('layouts.element.keyPoint')@endcomponent
            </label>
            <input type="text" class="form-control" id="sum" name="sum" placeholder="需要生成的题目数量(100以内)"
                   value="{{old('sum')}}">
        </div>
        <div class="form-group">
            <label for="min">输入需要生成的范围中最小的数(范围:0-100) @component('layouts.element.keyPoint')@endcomponent
            </label>
            <input type="text" class="form-control" id="min" name="min" placeholder="输入需要生成的范围(0-100)"
                   value="{{old('min')}}">
        </div>
        <div class="form-group">
            <label for="max">输入需要生成的范围中最大的数(范围:0-100) @component('layouts.element.keyPoint')@endcomponent
            </label>
            <input type="text" class="form-control" id="max" name="max" placeholder="输入需要生成的范围(0-100)"
                   value="{{old('max')}}">
        </div>
        <label for="Fruit">选择需要的运算 @component('layouts.element.keyPoint')@endcomponent
        </label>
        <div class="checkbox" style="zoom:140%;">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="addition" value="1" @if(old('addition')) checked @endif>
                    加法
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="subtraction" value="1" @if(old('subtraction')) checked @endif>
                    减法
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="multiplication" value="1" @if(old('multiplication')) checked @endif>
                    乘法
                </label>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="divisionMethod" value="1" @if(old('divisionMethod')) checked @endif>
                    除法
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-info">点击生成题目</button>
    </form>
@endsection
