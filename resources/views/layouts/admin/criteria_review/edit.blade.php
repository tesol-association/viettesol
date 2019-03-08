@extends('layouts.admin.conference_layout')
@section('title','Edit Criteria Review')
@section('css')
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Criteria Review</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_criteria_review_list', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Criteria Review List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_criteria_review_update', ["conference_id" => $conference->id, "id" => $criteriaReview->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('name') ? 'has-error' : ''}}">
                        <label for="name">Name*</label>
                        <input id="name" type="text" class="form-control" placeholder="Enter Title" name="name" required value="{{ $criteriaReview->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('possible_values') ? 'has-error' : ''}}">
                        <label>Possible Values*</label>
                        <input type="text" class="form-control possible_values" placeholder="Each Value is separated by commas. Example: 1, 2, 3, 4, 5" name="possible_values" required value="{{ implode(',', json_decode($criteriaReview->possible_values, true)) }}">
                        @if ($errors->has('possible_values'))
                            <span class="help-block">{{ $errors->first('possible_values') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('description') ? 'has-error' : ''}}">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description ...">{{ $criteriaReview->description }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>
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
