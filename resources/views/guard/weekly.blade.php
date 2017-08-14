@extends('layouts.app')

@section('page-header'){{ trans('تعیین نگهبانی هفتگی') }}@endsection

@section('page_title'){{ trans('تعیین نگهبانی هفتگی') }}@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-right">{{ trans('تعیین نگهبانی هفتگی') }}</h1>
    </section>

    <div class="clearfix"></div>

    <div class="content">

        <div class="box box-primary">
            <div class="box-body">
                <a href="{{ route('guard.weekly', ['week_diff' => request()->input('week_diff') - 1]) }}" class="col-md-3 btn btn-info">هفته قبل</a>
                <span class="col-md-6 btn btn-default">از {{ $jWeekStart }} تا {{ $jWeekEnd }}</span>
                <a href="{{ route('guard.weekly', ['week_diff' => request()->input('week_diff') + 1]) }}" class="col-md-3 btn btn-info">هفته بعد</a>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                {!! Form::open(['url' => route('guard.weekly', ['week_diff' => request()->input('week_diff')]), 'method' => 'post'])  !!}
                <table class="table table-striped table-responsive" id="weekly_guard_table">
                    <thead>
                    <tr>
                        <th></th>
                        <th>
                            <label>
                                {{ Form::checkbox('weekday[0]', $weekDays[0]['date'], $weekDays[0]['enabled']/*, ['disabled' => !$weekDays[0]['enabled']]*/) }}
                                <span>شنبه</span>
                                <br>
                                {{ $weekDays[0]['jDate'] }}
                            </label>
                        </th>
                        <th>
                            <label>
                                {{ Form::checkbox('weekday[1]', $weekDays[1]['date'], $weekDays[1]['enabled']/*, ['disabled' => !$weekDays[1]['enabled']]*/) }}
                                <span>یک شنبه</span>
                                <br>
                                {{ $weekDays[1]['jDate'] }}
                            </label>
                        </th>
                        <th>
                            <label>
                                {{ Form::checkbox('weekday[2]', $weekDays[2]['date'], $weekDays[2]['enabled']/*, ['disabled' => !$weekDays[2]['enabled']]*/) }}
                                <span>دو شنبه</span>
                                <br>
                                {{ $weekDays[2]['jDate'] }}
                            </label>
                        </th>
                        <th>
                            <label>
                                {{ Form::checkbox('weekday[3]', $weekDays[3]['date'], $weekDays[3]['enabled']/*, ['disabled' => !$weekDays[3]['enabled']]*/) }}
                                <span>سه شنبه</span>
                                <br>
                                {{ $weekDays[3]['jDate'] }}
                            </label>
                        </th>
                        <th>
                            <label>
                                {{ Form::checkbox('weekday[4]', $weekDays[4]['date'], $weekDays[4]['enabled']/*, ['disabled' => !$weekDays[4]['enabled']]*/) }}
                                <span>چهار شنبه</span>
                                <br>
                                {{ $weekDays[4]['jDate'] }}
                            </label>
                        </th>
                        <th>
                            <label>
                                {{ Form::checkbox('weekday[5]', $weekDays[5]['date'], $weekDays[5]['enabled']/*, ['disabled' => !$weekDays[5]['enabled']]*/) }}
                                <span>پنج شنبه</span>
                                <br>
                                {{ $weekDays[5]['jDate'] }}
                            </label>
                        </th>
                        <th>
                            <label>
                                {{ Form::checkbox('weekday[6]', $weekDays[6]['date'], $weekDays[6]['enabled']/*, ['disabled' => !$weekDays[6]['enabled']]*/) }}
                                <span>جمعه</span>
                                <br>
                                {{ $weekDays[6]['jDate'] }}
                            </label>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($guardTypes as $guardType)
                        <tr>
                            <th>تعداد نگهبان {{ $guardType->name }}</th>
                            <td>{{ Form::text('guards_number[0]' . '[' . $guardType->id . ']', $guardType->guards_number, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                            <td>{{ Form::text('guards_number[1]' . '[' . $guardType->id . ']', $guardType->guards_number, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                            <td>{{ Form::text('guards_number[2]' . '[' . $guardType->id . ']', $guardType->guards_number, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                            <td>{{ Form::text('guards_number[3]' . '[' . $guardType->id . ']', $guardType->guards_number, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                            <td>{{ Form::text('guards_number[4]' . '[' . $guardType->id . ']', $guardType->guards_number, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                            <td>{{ Form::text('guards_number[5]' . '[' . $guardType->id . ']', $guardType->guards_number, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                            <td>{{ Form::text('guards_number[6]' . '[' . $guardType->id . ']', $guardType->guards_number, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <th>مسافت نگهبان</th>
                        <td>{{ Form::select('guard_distance[0]', $distanceTypes, null, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                        <td>{{ Form::select('guard_distance[1]', $distanceTypes, null, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                        <td>{{ Form::select('guard_distance[2]', $distanceTypes, null, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                        <td>{{ Form::select('guard_distance[3]', $distanceTypes, null, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                        <td>{{ Form::select('guard_distance[4]', $distanceTypes, null, ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                        <td>{{ Form::select('guard_distance[5]', $distanceTypes, 'far', ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                        <td>{{ Form::select('guard_distance[6]', $distanceTypes, 'far', ['type' => 'text', 'class' => 'form-control', 'style' => 'width: 120px; display: inline-block;']) }}</td>
                    </tr>
                    <tr>
                        <th>نگهبان متاهل</th>
                        <td>{{ Form::checkbox('married_guard[0]', true, true) }}</td>
                        <td>{{ Form::checkbox('married_guard[1]', true, true) }}</td>
                        <td>{{ Form::checkbox('married_guard[2]', true, true) }}</td>
                        <td>{{ Form::checkbox('married_guard[3]', true, true) }}</td>
                        <td>{{ Form::checkbox('married_guard[4]', true, true) }}</td>
                        <td>{{ Form::checkbox('married_guard[5]', true) }}</td>
                        <td>{{ Form::checkbox('married_guard[6]', true) }}</td>
                    </tr>
                    <tr>
                        <th>حداقل زمان بین دو نگهبانی</th>
                        <td colspan="7">{{ Form::select('between_days', [0 => 'مهم نیست', 1 => '24 ساعت', 2 => '48 ساعت'], 1, ['class' => 'form-control']) }}</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="7"><button type="submit" name="set_guard" value="true" class="btn btn-success pull-right">تعیین برنامه</button></td>
                    </tr>
                    </tbody>
                </table>
                {!! Form::close()  !!}
            </div>
        </div>

    </div>
@endsection

@section('styles')
    <style>
        #weekly_guard_table td, #weekly_guard_table th {
            text-align: center;
        }
    </style>
@endsection