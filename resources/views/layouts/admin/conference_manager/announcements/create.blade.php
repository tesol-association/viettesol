@extends('layouts.admin.conference_layout')
@section('title','Announcements Management')
@section('css')
    <link href="{{ asset('js/lib/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Create Announcement</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_announcements_list', ['conference_id' => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Announcements List</a>
            </div>
        </div>
        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_announcements_store', ['conference_id' => $conference->id]) }}">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('title') ? 'has-error' : ''}}">
                        <label for="title">Title*</label>
                        <input id="title" type="text" class="form-control" placeholder="Enter Title" name="title" required value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <span class="help-block">{{ $errors->first('title') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('body') ? 'has-error' : ''}}">
                        <label for="body">Body</label>
                        <textarea name="body" id="body" class="form-control" rows="3" placeholder="Enter Body ...">{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">{{ $errors->first('body') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('short_content') ? 'has-error' : ''}}">
                        <label for="short_content">Short Content</label>
                        <textarea name="short_content" id="short_content" class="form-control" rows="3" placeholder="Enter Short Content ...">{{ old('short_content') }}</textarea>
                        @if ($errors->has('short_content'))
                            <span class="help-block">{{ $errors->first('short_content') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('expiry_date') ? 'has-error' : ''}}">
                        <label for="expiry_date">Expiry Date*</label>
                        <input id="expiry_date" type='text' class="form-control" name="expiry_date" required value="{{ old('expiry_date') }}" />
                        @if ($errors->has('expiry_date'))
                            <span class="help-block">{{ $errors->first('expiry_date') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status">Status*</label>
                        <select id="status" name="status" class="form-control" data-placeholder="Select a Tags" style="width: 100%;" required>
                            <option value="draft">Draft</option>
                            <option value="approved">Approved</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('js/admin/announcements/create.js') }}"></script>
@endsection
