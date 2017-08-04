@extends('layouts.app')

@section('page-header'){{ trans('ورودی از فایل excel') }}@endsection

@section('page_title'){{ trans('ورودی از فایل excel') }}@endsection

@section('content')
    <section class="content-header">
        <h1 class="pull-right">{{ trans('ورودی از فایل excel') }}</h1>
    </section>

    <div class="clearfix"></div>

    <div class="content">
        @include('common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div>
                    <p>در این قسمت می توانید اعتبار کاربران را افزایش دهید.</p>
                    {!! Form::open(['route' => ['users.import'], 'method' => 'post', 'files' => true, 'class' => 'form-horizontal']) !!}<!-- Name Field -->
                    <div class="form-group">
                        <label class="control-label col-sm-2 req" for="file">انتخاب فایل excel:</label>
                        <div class="col-sm-10">
                            {!! Form::file('file') !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default" name="action" value="read_file">{{ trans('افزایش') }}</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        @if (!empty($users) && $users->count())
            <div class="box box-primary">
                <div class="box-body">
                    <div>
                        <p>در این قسمت می توانید اعتبار کاربران را افزایش دهید.</p>
                        {!! Form::open(['route' => ['users.import'], 'method' => 'post', 'files' => true, 'class' => 'form-horizontal']) !!}<!-- Name Field -->
                        <table class="table table-responsive" id="users-table">
                            <thead>
                            <tr>
                                {{--<th class="text-center">#</th>--}}
                                <th class="text-center">@lang('users.personnel_id')</th>
                                <th>@lang('users.first_name')</th>
                                <th>@lang('users.last_name')</th>
                                <th class="text-center">@lang('users.free_of_war')</th>
                                <th class="text-center">@lang('users.married')</th>
                                <th class="text-center">@lang('users.senior')</th>
                                <th class="text-center">@lang('users.secretary')</th>
                                <th class="text-center">@lang('users.partaker')</th>
                                <th class="text-center">@lang('users.long_distance')</th>
                                <th>@lang('users.extra_description')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    {{--<td>{{ ($key + 1) }}</td>--}}
                                    <td class="text-center">
                                        {{ Form::input('text', 'user[' . $key . '][personnel_id]', $user->personnel_id, ['class' => 'form-control', 'style' => 'width: 60px; display: inline-block;']) }}
                                        {{--{{ $user->personnel_id }}--}}
                                    </td>
                                    <td>
                                        {{ Form::input('text', 'user[' . $key . '][first_name]', $user->first_name, ['class' => 'form-control', 'style' => 'width: 150px; display: inline-block;']) }}
                                        {{--{{ $user->first_name }}--}}
                                    </td>
                                    <td>
                                        {{ Form::input('text', 'user[' . $key . '][last_name]', $user->last_name, ['class' => 'form-control', 'style' => 'width: 150px; display: inline-block;']) }}
                                        {{--{{ $user->last_name }}--}}
                                    </td>
                                    <td class="text-center">
                                        {{ Form::checkbox('user[' . $key . '][free_of_war]', null, $user->free_of_war) }}
                                        {{--{{ $user->free_of_war }}--}}
                                    </td>
                                    <td class="text-center">
                                        {{ Form::checkbox('user[' . $key . '][married]', null, $user->married) }}
                                        {{--{{ $user->married }}--}}
                                    </td>
                                    <td class="text-center">
                                        {{ Form::checkbox('user[' . $key . '][senior]', null, $user->senior) }}
                                        {{--{{ $user->senior }}--}}
                                    </td>
                                    <td class="text-center">
                                        {{ Form::checkbox('user[' . $key . '][secretary]', null, $user->secretary) }}
                                        {{--{{ $user->secretary }}--}}
                                    </td>
                                    <td class="text-center">
                                        {{ Form::checkbox('user[' . $key . '][partaker]', null, $user->partaker) }}
                                        {{--{{ $user->partaker }}--}}
                                    </td>
                                    <td class="text-center">
                                        {{ Form::checkbox('user[' . $key . '][long_distance]', null, $user->long_distance) }}
                                        {{--{{ $user->long_distance }}--}}
                                    </td>
                                    <td>
                                        {{ Form::input('text', 'user[' . $key . '][extra_description]', $user->extra_description, ['class' => 'form-control', 'style' => 'width: 150px; display: inline-block;']) }}
                                        {{--{{ $user->extra_description }}--}}
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="11">
                                    <div class='btn-group'>
                                        <a href="{{ route('users.import') }}" class="btn btn-default">{{ trans('لغو') }}</a>
                                    </div>
                                    <div class='btn-group'>
                                        <button type="submit" class="btn btn-default" name="action" value="import">{{ trans('ثبت نهایی') }}</button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
