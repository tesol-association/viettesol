@extends('layouts.admin.conference_layout')
@section('title','Edit Review Form')
@section('css')
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Edit Review Form</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_review_form_list', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Review Form List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_review_form_store', ["conference_id" => $conference->id]) }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('name') ? 'has-error' : ''}}">
                        <label for="name">Name*</label>
                        <input id="name" type="text" class="form-control" placeholder="Enter Title" name="name" required value="{{ $reviewForm->name }}">
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('attach_file') ? 'has-error' : ''}}">
                        <label for="attach_file">Attach File</label>
                        <input type="file" id="attach_file" name="attach_file">
                        @if ($errors->has('attach_file'))
                            <span class="help-block">{{ $errors->first('attach_file') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('criteria') ? 'has-error' : ''}}">
                        <label for="choose_criteria">Choose Criteria*</label>
                        <select id="choose_criteria" name="criteria[]" class="form-control" multiple="multiple" data-placeholder="Select one or many Criteria" style="width: 100%;" required>
                            @foreach ($criterias as $criteria)
                                @if (in_array($criteria->id, $criteriaSelected))
                                    <option value="{{ $criteria->id }}" selected>{{ $criteria->name }}</option>
                                @else
                                    <option value="{{ $criteria->id }}">{{ $criteria->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('criteria'))
                            <span class="help-block">{{ $errors->first('body') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" data-placeholder="Select a Tags" style="width: 100%;" required>
                            <option value="active">Active</option>
                            <option value="inactive">InActive</option>
                        </select>
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
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/review_form/create.js') }}"></script>
@endsection
