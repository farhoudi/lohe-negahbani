
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

<li class="{{ request()->is('guard*') ? 'active' : '' }} treeview">
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
        <li class="{{ request()->is('guard/midterm') ? 'active' : '' }}">
            <a href="{!! route('guard.midterm') !!}"><i class="fa fa-users"></i><span>{{ trans('guard.midterm') }}</span></a>
        </li>
        <li class="{{ request()->is('guard/patrol') ? 'active' : '' }}">
            <a href="{!! route('guard.patrol') !!}"><i class="fa fa-users"></i><span>{{ trans('guard.patrol') }}</span></a>
        </li>
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
        <li class="{{ request()->is('guardian_table/midterm') ? 'active' : '' }}">
            <a href="{!! route('guardian_table.midterm') !!}"><i class="fa fa-users"></i><span>{{ trans('guard.midterm_guard') }}</span></a>
        </li>
        <li class="{{ request()->is('guardian_table/patrol') ? 'active' : '' }}">
            <a href="{!! route('guardian_table.patrol') !!}"><i class="fa fa-users"></i><span>{{ trans('guard.patrol_guard') }}</span></a>
        </li>
    </ul>
</li>

{{--
    <li class="{{ request()->is('admin/courses*') ? 'active' : '' }}">
        <a href="{!! route('admin.courses.index') !!}"><i class="fa fa-book"></i><span>{{ trans('courses.courses') }}</span></a>
    </li>

    <li class="{{ request()->is('categories*') ? 'active' : '' }}">
        <a href="{!! route('categories.index') !!}"><i class="fa fa-folder"></i><span>{{ trans('categories.categories') }}</span></a>
    </li>

    <li class="{{ request()->is('ads*') ? 'active' : '' }}">
        <a href="{!! route('ads.index') !!}"><i class="fa fa-barcode"></i><span>{{ trans('ads.ads') }}</span></a>
    </li>

@permission(('view-apps'))
    <li class="{{ request()->is('apps*') ? 'active' : '' }}">
        <a href="{!! route('apps.index') !!}"><i class="fa fa-mobile fa-lg"></i><span>{{ trans('apps.app') }}</span></a>
    </li>
@endpermission

@permission((['view-gift-cards', 'add-users-credit', 'add-user-groups-credit']))
    <li class="{{ (request()->is('give_credit*') || request()->is('user_give_credit*') || request()->is('gift_cards*')) ? 'active' : '' }} treeview">
        <a href="#">
            <i class="fa fa-money"></i> <span>{{ trans('اعتبارات') }}</span>
            <span class="pull-left-container">
                <i class="fa fa-angle-left pull-left"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @permission(('add-user-groups-credit'))
                <li class="{{ request()->is('give_credit*') ? 'active' : '' }}">
                    <a href="{!! route('user_groups.give_credit') !!}"><i class="fa fa-users"></i><span>{{ trans('افزایش اعتبار گروه کاربری') }}</span></a>
                </li>
            @endpermission
            @permission(('add-users-credit'))
                <li class="{{ request()->is('user_give_credit*') ? 'active' : '' }}">
                    <a href="{!! route('users.give_credit') !!}"><i class="fa fa-user"></i><span>{{ trans('افزایش اعتبار کاربر') }}</span></a>
                </li>
            @endpermission
            @permission(('view-gift-cards'))
                <li class="{{ request()->is('gift_cards*') ? 'active' : '' }}">
                    <a href="{!! route('gift_cards.index') !!}"><i class="fa fa-gift fa-lg"></i><span>{{ trans('gift_cards.gift_cards') }}</span></a>
                </li>
            @endpermission
        </ul>
    </li>
@endpermission

@permission((['view-users', 'view-user-groups']))
    <li class="{{ (request()->is('users*') || request()->is('user_groups*')) ? 'active' : '' }} treeview">
        <a href="#">
            <i class="fa fa-users"></i> <span>{{ trans('users.manage_users') }}</span>
            <span class="pull-left-container">
                <i class="fa fa-angle-left pull-left"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @permission(('view-user-groups'))
                <li class="{{ request()->is('user_groups*') ? 'active' : '' }}">
                    <a href="{!! route('user_groups.index') !!}"><i class="fa fa-users"></i><span>{{ trans('user_groups.user_groups') }}</span></a>
                </li>
            @endpermission
            @permission(('view-users'))
                <li class="{{ request()->is('users*') ? 'active' : '' }}">
                    <a href="{!! route('users.index') !!}"><i class="fa fa-user"></i><span>{{ trans('users.users') }}</span></a>
                </li>
            @endpermission
        </ul>
    </li>
@endpermission

@permission(('view-feedbacks'))
    <li class="{{ request()->is('feedbacks*') ? 'active' : '' }}">
        <a href="{!! route('feedbacks.index') !!}"><i class="fa fa-envelope"></i><span>{{ trans('feedbacks.feedbacks') }}</span></a>
    </li>
@endpermission

@permission((['view-roles', 'view-permissions']))
    <li class="{{ (request()->is('roles*') || (request()->is('permissions*') && !request()->is('permissions/role_permissions*')) || request()->is('permissions/role_permissions*')) ? 'active' : '' }} treeview">
        <a href="#">
            <i class="fa fa-lock"></i> <span>{{ trans('roles.acl') }}</span>
            <span class="pull-left-container">
                <i class="fa fa-angle-left pull-left"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            @permission(('view-roles'))
                <li class="{{ request()->is('roles*') ? 'active' : '' }}">
                    <a href="{!! route('roles.index') !!}"><i class="fa fa-user-o"></i><span>{{ trans('roles.roles') }}</span></a>
                </li>
            @endpermission
            @permission(('view-permissions'))
                <li class="{{ (request()->is('permissions*') && !request()->is('permissions/role_permissions*')) ? 'active' : '' }}">
                    <a href="{!! route('permissions.index') !!}"><i class="fa fa-key"></i><span>{{ trans('permissions.permissions') }}</span></a>
                </li>
            @endpermission
        </ul>
    </li>
@endpermission


<li>
    <a href="{!! url('/') !!}"><i class="fa fa-desktop"></i><span>{{ trans('مشاهده وبسایت') }}</span></a>
</li>--}}

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