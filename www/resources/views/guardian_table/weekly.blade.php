@extends('layouts.app')

@section('page-header'){{ trans('لوح نگهبانی هفتگی') }}@endsection

@section('page_title'){{ trans('لوح نگهبانی هفتگی') }}@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-right">{{ trans('لوح نگهبانی هفتگی') }}</h1>
    </section>

    <div class="clearfix"></div>

    <div class="content">

        <div class="box box-primary">
            <div class="box-body">
                <a href="{{ route('guardian_table.weekly', ['week_diff' => request()->input('week_diff') - 1]) }}" class="col-md-3 btn btn-info">هفته قبل</a>
                <span class="col-md-6 btn btn-default">از {{ $jWeekStart }} تا {{ $jWeekEnd }}</span>
                <a href="{{ route('guardian_table.weekly', ['week_diff' => request()->input('week_diff') + 1]) }}" class="col-md-3 btn btn-info">هفته بعد</a>
            </div>
        </div>

        <div class="box box-primary">
            <div class="box-body">
                {{--{!! Form::open(['url' => route('guard.weekly', ['week_diff' => request()->input('week_diff')]), 'method' => 'post'])  !!}--}}
                <table class="table table-striped table-responsive" id="weekly_guard_table">
                    <thead>
                    <tr>
                        <th>پست</th>
                        @foreach ($weekDays as $weekDay)
                            <th>
                                <label>
                                    <span>{{ $weekDay['jWeekdayName'] }}</span>
                                    <br>
                                    {{ $weekDay['jDate'] }}
                                </label>
                            </th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($guardTypes as $guardType)
                        <tr>
                            <td>{{ $guardType->name }}</td>
                            @foreach ($weekDays as $weekDay)
                                <td>
                                    <ul class="nav nav-stacked">

                                    @foreach ($guards->where('day_id', $weekDay['day_id'])->where('guard_type_id', $guardType->id)->all() as $guard)
                                        <li>
                                            <a>
                                                <i class="fa fa-info-circle"
                                                   data-toggle="modal"
                                                   data-target="#modal-guard-info"
                                                   onclick="fillGuardInfo('{{ $guard->id }}', '{{ $guard->user->full_name }}', '{{ $guard->user->personnel_id }}',
                                                           '{{ $guard->user->guards->count() }}', '<i class=\'fa fa-{{ $guard->user->free_of_war ? 'check' : 'times' }}\'></i>',
                                                           '<i class=\'fa fa-{{ $guard->user->married ? 'check' : 'times' }}\'></i>',
                                                           '<i class=\'fa fa-{{ $guard->user->long_distance ? 'check' : 'times' }}\'></i>');"></i>
                                                {{ $guard->user->personnel_id . ': ' . $guard->user->full_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                    </ul>

                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="modal modal-default fade" id="modal-guard-info" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span></button>
                                <h4 class="modal-title">اطلاعات فرد</h4>
                            </div>
                            <div class="modal-body">
                                <div>
                                    <table class="table">
                                        <tbody>
                                        <tr>
                                            <td>نام و نام خانوادگی</td>
                                            <th id="info_guard_user_full_name"></th>
                                        </tr>
                                        <tr>
                                            <td>شماره پرسنلی</td>
                                            <th id="info_guard_user_personnel_id"></th>
                                        </tr>
                                        <tr>
                                            <td>تعداد پست های تعیین شده</td>
                                            <th id="info_guard_user_guards_count"></th>
                                        </tr>
                                        <tr>
                                            <td>معاف از رزم</td>
                                            <th id="info_guard_user_free_of_war"></th>
                                        </tr>
                                        <tr>
                                            <td>متاهل</td>
                                            <th id="info_guard_user_married"></th>
                                        </tr>
                                        <tr>
                                            <td>راه دور</td>
                                            <th id="info_guard_user_long_distance"></th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="panel-group">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title" data-toggle="collapse" href="#collapse-users" style="cursor: pointer;">
                                                <a>تعویض پست</a>
                                            </h4>
                                        </div>
                                        <div id="collapse-users" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <table class="table" id="users_table">
                                                    <thead>
                                                    <tr>
                                                        <td>نام و نام خانوادگی</td>
                                                        <td>شماره پرسنلی</td>
                                                        <td>تعداد پست</td>
                                                        <td>معاف از رزم</td>
                                                        <td>متاهل</td>
                                                        <td>راه دور</td>
                                                        <td></td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach ($users as $user)
                                                        <tr>
                                                            <td>{{ $user->full_name }}</td>
                                                            <td>{{ $user->personnel_id }}</td>
                                                            <td>{{ $user->guards->count() }}</td>
                                                            <td><i class='fa fa-{{ $user->free_of_war ? 'check' : 'times' }}'></i></td>
                                                            <td><i class='fa fa-{{ $user->married ? 'check' : 'times' }}'></i></td>
                                                            <td><i class='fa fa-{{ $user->long_distance ? 'check' : 'times' }}'></i></td>
                                                            <td>
                                                                {!! Form::open(['url' => route('guardian_table.change_guard'), 'method' => 'post'])  !!}
                                                                {{ Form::hidden('guard_id', '', ['class' => 'guard_id_inputs']) }}
                                                                {{--{{ Form::hidden('old_user_id', $guard->user->id, ['id' => 'old_user_id_input']) }}--}}
                                                                {{ Form::hidden('new_user_id', $user->id, ['id' => 'new_user_id_input']) }}
                                                                <button type="submit" class="btn btn-sm btn-info">تعویض</button>
                                                                {!! Form::close()  !!}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--<div class="modal-footer">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" style="">بستن</button>
                                --}}{{--<button type="button" class="btn btn-outline">Save changes</button>--}}{{--
                            </div>--}}
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
                {{--{!! Form::close()  !!}--}}
            </div>
        </div>

    </div>
@endsection

@section('top-scripts')
    <script>
        function fillGuardInfo(guardId, guardUserFullName, guardUserPersonnelId, guardUserGuardsCount, guardUserFreeOfWar, guardUserMarried, guardUserLongDistance) {
            var guardIdInputs = document.getElementsByClassName('guard_id_inputs');
            for (var i = 0; i < guardIdInputs.length; i++) {
                guardIdInputs[i].value = guardId;
            }
            document.getElementById('info_guard_user_full_name').innerHTML = guardUserFullName;
            document.getElementById('info_guard_user_personnel_id').innerHTML = guardUserPersonnelId;
            document.getElementById('info_guard_user_guards_count').innerHTML = guardUserGuardsCount;
            document.getElementById('info_guard_user_free_of_war').innerHTML = guardUserFreeOfWar;
            document.getElementById('info_guard_user_married').innerHTML = guardUserMarried;
            document.getElementById('info_guard_user_long_distance').innerHTML = guardUserLongDistance;
        }
    </script>
@endsection

@section('styles')
    <style>
        #weekly_guard_table td, #weekly_guard_table th {
            text-align: center;
        }
        .popover{
            min-width: 250px !important; /* Max Width of the popover (depending on the container!) */
        }

        #users_table tbody, #users_table thead { display: block; width: 100%; }
        #users_table tr { width: 100%; }
        #users_table td { width: 14%; }
        #users_table td { text-align: center !important; }
        #users_table tbody {
            height: 200px;
            overflow-y: auto;
            overflow-x: hidden;
        }
    </style>
@endsection