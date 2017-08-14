@extends('layouts.app')

@section('page-header'){{ trans('درباره نرم افزار') }}@endsection

@section('page_title'){{ trans('درباره نرم افزار') }}@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-right">{{ trans('درباره نرم افزار') }}</h1>
    </section>

    <div class="clearfix"></div>

    <div class="content">

        <div class="box box-primary">
            <div class="box-header">
                <h3>نرم افزار لوح نگهبانی</h3>
            </div>
            <div class="box-body">
                <p class="text-center">این نرم افزار توسط دانشجویان وظیفه اعزامی 1396/4/1 تهیه و به جمعی گردان یکم گروهان چهارم از مرکز آموزشی شهدای جوادنیا تقدیم میگردد.</p>
                <p><br><br></p>
                <h4>فرمانده گروهان</h4>
                <h3>ستوانیکم پاسدار مهدی فریبی</h3>
                <p><br><br></p>
                <h4>مربیان</h4>
                <h3>ستوان سوم پاسدار سید سجاد موسوی</h3>
                <h3>استوار یکم پاسدار علی محرابی</h3>
            </div>
        </div>


    </div>
@endsection

@section('styles')
    <style>
        h3, h4, h5 {
            text-align: center;
        }
    </style>
@endsection