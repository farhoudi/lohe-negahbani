@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-right">{{ $user->full_name }}</h1>
    </section>

    <div class="clearfix"></div>

    <div class="content">
        @include('common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'patch']) !!}

                    @include('users.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        {{--<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false">دوره ها</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="true">تراکنش ها</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <b>دوره های خریداری شده:</b>
                    <ul>
                        @foreach($userCourses as $course)
                            <li>
                                <a href="{{ route('courses.show', ['id' => $course->id, 'slug' => str_slug($course->title)]) }}"
                                   class="alert-link" style="display: block; margin: 5px;">{{ $course->title }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="tab-pane" id="tab_2">
                    <b>تراکنش های مالی کاربر:</b>
                    <table class="table table-hover dashboard-transactions-table">
                        <thead>
                        <tr>
                            <th> رخداد</th>
                            <th> تغییر | تومان</th>
                            <th> تاریخ</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($userTransactions as $transaction)
                            <tr>
                                <td>{{ $transaction->description }}</td>
                                <td>{{ number_format($transaction->amount) }}</td>
                                <td class="ltr">{{ $transaction->j_date }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>--}}
    </div>
@endsection