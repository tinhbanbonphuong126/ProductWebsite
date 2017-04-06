@extends('layouts.app-one')

@section('content')
<div class="container">

    <h1>Edit urequest {{ $urequest->id }}</h1>

    {!! Form::model($urequest, [
        'method' => 'PATCH',
        'url' => ['/urequest', $urequest->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

                    <div class="form-group {{ $errors->has('funeral_id') ? 'has-error' : ''}}">
                {!! Form::label('funeral_id', 'Funeral Id', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('funeral_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('funeral_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('funeral_name') ? 'has-error' : ''}}">
                {!! Form::label('funeral_name', 'Funeral Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('funeral_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('funeral_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('start_time') ? 'has-error' : ''}}">
                {!! Form::label('start_time', 'Start Time', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::date('start_time', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('start_time', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('religious') ? 'has-error' : ''}}">
                {!! Form::label('religious', 'Religious', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('religious', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('religious', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('faction') ? 'has-error' : ''}}">
                {!! Form::label('faction', 'Faction', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('faction', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('faction', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('otera_name') ? 'has-error' : ''}}">
                {!! Form::label('otera_name', 'Otera Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('otera_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('otera_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('venue') ? 'has-error' : ''}}">
                {!! Form::label('venue', 'Venue', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('venue', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('venue', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('venue_address') ? 'has-error' : ''}}">
                {!! Form::label('venue_address', 'Venue Address', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('venue_address', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('venue_address', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('times_funeral') ? 'has-error' : ''}}">
                {!! Form::label('times_funeral', 'Times Funeral', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('times_funeral', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('times_funeral', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('contact_matter') ? 'has-error' : ''}}">
                {!! Form::label('contact_matter', 'Contact Matter', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('contact_matter', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('contact_matter', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection