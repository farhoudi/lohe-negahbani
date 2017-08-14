
<li class="{{ request()->is('dashboard') ? 'active' : '' }}">
    <a href="{!! route('dashboard') !!}"><i class="fa fa-dashboard"></i><span>{{ trans('dashboard.dashboard') }}</span></a>
</li>

<li class="{{ request()->is('users*') ? 'active' : '' }} treeview">
    <a href="#">
        <i class="fa fa-users"></i> <span>{{ trans('users.users') }}</span>
        <span class="pull-left-container">
            <i class="fa fa-angle-left pull-left"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ request()->is('users*') ? 'active' : '' }}">
            <a href="{!! route('users.index') !!}"><i class="fa fa-users"></i><span>{{ trans('لیست') }}</span></a>
        </li>
        <li class="{{ request()->is('users/import') ? 'active' : '' }}">
            <a href="{!! route('users.import') !!}"><i class="fa fa-user"></i><span>{{ trans('ورودی از فایل excel') }}</span></a>
        </li>
        {{--<li class="{{ request()->is('users*') ? 'active' : '' }}">
            <a href="{!! url('users.index') !!}"><i class="fa fa-user"></i><span>{{ trans('خروجی به فایل excel') }}</span></a>
        </li>--}}
    </ul>
</li>

<li class="{{ request()->is('guard*') && !request()->is('guardian_table*') ? 'active' : '' }} treeview">
    <a href="#">
        <i class="fa fa-users"></i> <span>{{ trans('guard.set_guard') }}</span>
        <span class="pull-left-container">
            <i class="fa fa-angle-left pull-left"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ request()->is('guard/weekly') ? 'active' : '' }}">
            <a href="{!! route('guard.weekly') !!}"><i class="fa fa-users"></i><span>{{ trans('guard.weekly') }}</span></a>
        </li>
        {{--<li class="{{ request()->is('guard/midterm') ? 'active' : '' }}">
            <a href="{!! route('guard.midterm') !!}"><i class="fa fa-users"></i><span>{{ trans('guard.midterm') }}</span></a>
        </li>
        <li class="{{ request()->is('guard/patrol') ? 'active' : '' }}">
            <a href="{!! route('guard.patrol') !!}"><i class="fa fa-users"></i><span>{{ trans('guard.patrol') }}</span></a>
        </li>--}}
    </ul>
</li>

<li class="{{ request()->is('guardian_table*') ? 'active' : '' }} treeview">
    <a href="#">
        <i class="fa fa-table"></i> <span>{{ trans('guard.guardian_table') }}</span>
        <span class="pull-left-container">
            <i class="fa fa-angle-left pull-left"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ request()->is('guardian_table/weekly') ? 'active' : '' }}">
            <a href="{!! route('guardian_table.weekly') !!}"><i class="fa fa-users"></i><span>{{ trans('guard.weekly_guard') }}</span></a>
        </li>
        {{--<li class="{{ request()->is('guardian_table/midterm') ? 'active' : '' }}">
            <a href="{!! route('guardian_table.midterm') !!}"><i class="fa fa-users"></i><span>{{ trans('guard.midterm_guard') }}</span></a>
        </li>
        <li class="{{ request()->is('guardian_table/patrol') ? 'active' : '' }}">
            <a href="{!! route('guardian_table.patrol') !!}"><i class="fa fa-users"></i><span>{{ trans('guard.patrol_guard') }}</span></a>
        </li>--}}
    </ul>
</li>

<li class="{{ request()->is('about') ? 'active' : '' }}">
    <a href="{!! route('about') !!}"><i class="fa fa-info"></i><span>{{ trans('درباره نرم افزار') }}</span></a>
</li>

@section('scripts')
    <script>
        $('.treeview').on('click', function (evt) {
            var angle = $(this).find('span').find('i.pull-left');
            if ($(this).hasClass('active')) {
                angle.removeClass('fa-angle-down');
                angle.addClass('fa-angle-left');
            } else {
                angle.removeClass('fa-angle-left');
                angle.addClass('fa-angle-down');
            }
        });
    </script>
@endsection