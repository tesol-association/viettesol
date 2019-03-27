@extends('layouts.admin.conference_layout')
@section('title','Edit Track')
@section('css')
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Track {{ $track->name }} For Conference: {{ $conference->title }}</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_track_list', ["id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Track List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_track_update', ["conference_id" => $conference->id, "id" => $track->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('name') ? 'has-error' : ''}}">
                        <label for="name">Name*</label>
                        <input id="name" type="text" class="form-control" placeholder="Enter Title" name="name" required value="{{ $track->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('abbrev') ? 'has-error' : ''}}">
                        <label for="abbrev">Abbrev*</label>
                        <input id="abbrev" type="text" class="form-control" placeholder="Enter Title" name="abbrev" required value="{{ $track->abbrev }}">
                        @if ($errors->has('abbrev'))
                            <span class="help-block">{{ $errors->first('abbrev') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('policy') ? 'has-error' : ''}}">
                        <label for="policy">Policy</label>
                        <textarea name="policy" id="policy" class="form-control" rows="3" placeholder="Enter Policy ...">{{ $track->policy }}</textarea>
                        @if ($errors->has('policy'))
                            <span class="help-block">{{ $errors->first('policy') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('description') ? 'has-error' : ''}}">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description ...">{{ $track->description }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="review_form_id">Choose Review Form</label>
                        <select id="review_form_id" name="review_form_id" class="form-control">
                            <option value=""></option>
                            @foreach($reviewForms as $reviewForm)
                                @if (isset($track->review_form_id) && ($track->review_form_id == $reviewForm->id))
                                    <option value="{{ $reviewForm->id }}" selected>{{ $reviewForm->name }}</option>
                                @else
                                    <option value="{{ $reviewForm->id }}">{{ $reviewForm->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" name="conference_id" value="{{ $conference->id }}"/>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
            <!-- form end -->
        </div>
    </div>
@endsection
@section('js')
@endsection
