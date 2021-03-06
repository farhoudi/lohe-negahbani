@extends('layouts.app')

@section('page-header'){{ trans('افزودن اطلاعات نفر') }}@endsection

@section('page_title'){{ trans('افزودن اطلاعات نفر') }}@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-right">{{ trans('افزودن اطلاعات نفر') }}</h1>
    </section>

    <div class="clearfix"></div>

    <div class="content">
        @include('common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'users.store']) !!}

                    @include('users.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
