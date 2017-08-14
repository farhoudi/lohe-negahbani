<!-- personnel_id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('personnel_id', trans('users.personnel_id') . ':') !!}
    {!! Form::text('personnel_id', null, ['class' => 'form-control']) !!}
</div>
<div class="clearfix"></div>

<!-- first_name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('first_name', trans('users.first_name') . ':') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>
<div class="clearfix"></div>

<!-- last_name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('last_name', trans('users.last_name') . ':') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>
<div class="clearfix"></div>

<!-- free_of_war Field -->
<div class="form-group col-md-6">
    {!! Form::label('free_of_war', trans('users.free_of_war') . ':') !!}
    {!! Form::checkbox('free_of_war', true, null) !!}
</div>
<div class="clearfix"></div>

<!-- married Field -->
<div class="form-group col-md-6">
    {!! Form::label('married', trans('users.married') . ':') !!}
    {!! Form::checkbox('married', true, null) !!}
</div>
<div class="clearfix"></div>

<!-- senior Field -->
<div class="form-group col-md-6">
    {!! Form::label('senior', trans('users.senior') . ':') !!}
    {!! Form::checkbox('senior', true, null) !!}
</div>
<div class="clearfix"></div>

<!-- secretary Field -->
<div class="form-group col-md-6">
    {!! Form::label('secretary', trans('users.secretary') . ':') !!}
    {!! Form::checkbox('secretary', true, null) !!}
</div>
<div class="clearfix"></div>

<!-- partaker Field -->
<div class="form-group col-md-6">
    {!! Form::label('partaker', trans('users.partaker') . ':') !!}
    {!! Form::checkbox('partaker', true, null) !!}
</div>
<div class="clearfix"></div>

<!-- long_distance Field -->
<div class="form-group col-md-6">
    {!! Form::label('long_distance', trans('users.long_distance') . ':') !!}
    {!! Form::checkbox('long_distance', true, null) !!}
</div>
<div class="clearfix"></div>

<!-- extra_description Field -->
<div class="form-group col-md-6">
    {!! Form::label('extra_description', trans('users.extra_description') . ':') !!}
    {!! Form::textarea('extra_description', null, ['class' => 'form-control', 'rows' => 4]) !!}
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(trans('general.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('users.index') !!}" class="btn btn-default">{{ trans('general.cancel') }}</a>
</div>
