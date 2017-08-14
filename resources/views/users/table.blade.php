<table class="table table-responsive" id="users-table">
    <thead>
    <tr>
        <th class="text-center">#</th>
        <th>@sortablelink('personnel_id',  trans('users.personnel_id'))</th>
        <th>@sortablelink('first_name',  trans('users.first_name'))</th>
        <th>@sortablelink('last_name',  trans('users.last_name'))</th>
        <th>@sortablelink('free_of_war',  trans('users.free_of_war'))</th>
        <th>@sortablelink('married',  trans('users.married'))</th>
        <th>@sortablelink('senior',  trans('users.senior'))</th>
        <th>@sortablelink('secretary',  trans('users.secretary'))</th>
        <th>@sortablelink('partaker',  trans('users.partaker'))</th>
        <th>@sortablelink('long_distance',  trans('users.long_distance'))</th>
        <th>@sortablelink('guards_count',  trans('تعداد پست'))</th>
        <th>@lang('users.extra_description')</th>
        <th>{{ trans('general.actions') }}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $key => $user)
        <tr>
{{--            <td>{!! (/*$users->currentPage()*/1 - 1) * $users->count() + $key + 1 !!}</td>--}}
            <td>{!! $i++ !!}</td>
            <td class="text-center">{{ $user->personnel_id }}</td>
            <td>{{ $user->first_name }}</td>
            <td>{{ $user->last_name }}</td>
            <td class="text-center">{!! $user->free_of_war ? '<i class="fa fa-check"></i>' : ''  !!}</td>
            <td class="text-center">{!! $user->married ? '<i class="fa fa-check"></i>' : ''  !!}</td>
            <td class="text-center">{!! $user->senior ? '<i class="fa fa-check"></i>' : ''  !!}</td>
            <td class="text-center">{!! $user->secretary ? '<i class="fa fa-check"></i>' : ''  !!}</td>
            <td class="text-center">{!! $user->partaker ? '<i class="fa fa-check"></i>' : ''  !!}</td>
            <td class="text-center">{!! $user->long_distance ? '<i class="fa fa-check"></i>' : ''  !!}</td>
            <td class="text-center">{{ $user->guards->count() }}</td>
            <td>{{ $user->extra_description }}</td>
            <td>
                <div class='btn-group'>
                    <a href="{!! route('users.edit', [$user->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'delete', 'style' => 'display: inline-block;']) !!}
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('" . trans('general.are_you_sure_to_delete') . "')"]) !!}
                    {!! Form::close() !!}
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{--{{ $users->links() }}--}}