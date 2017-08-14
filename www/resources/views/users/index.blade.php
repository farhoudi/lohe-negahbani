@extends('layouts.app')

@section('page-header'){{ trans('users.users') }}@endsection

@section('page_title'){{ trans('users.users') }}@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-right">{{ trans('users.users') }}</h1>
        <h1 class="pull-left">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('users.create') !!}">
               {{ trans('general.add') }}
           </a>
        </h1>
    </section>

    <div class="clearfix"></div>

    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                @include('users.table')
            </div>
        </div>
    </div>
@endsection

