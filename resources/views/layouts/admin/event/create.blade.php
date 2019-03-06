@extends('layouts.admin.layout')
@section('title','Create Event')
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
            <h3 class="box-title">Create Event</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_event_list') }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Event List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_event_store') }}" enctype="multipart/form-data">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('title') ? 'has-error' : ''}}">
                        <label for="title">Title*</label>
                        <input id="title" type="text" class="form-control" placeholder="Enter Title" name="title" required value="{{ old('title') }}">
                        @if ($errors->has('title'))
                            <span class="help-block">{{ $errors->first('title') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('slug') ? 'has-error' : ''}}">
                        <label for="slug">Slug*</label>
                        <input id="slug" type="text" class="form-control" placeholder="Enter Title" name="slug" required value="{{ old('slug') }}">
                        @if ($errors->has('slug'))
                            <span class="help-block">{{ $errors->first('slug') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('cover') ? 'has-error' : ''}}">
                        <label for="exampleInputFile">Cover</label>
                        <input type="file" id="cover" name="cover" accept="image/*">
                        @if ($errors->has('cover'))
                            <span class="help-block">{{ $errors->first('cover') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('start_time') ? 'has-error' : ''}}">
                        <label for="start_time">Start Time</label>
                        <input id="start_time" type='text' class="form-control" name="start_time" required value="{{ old('start_time') }}" />
                        @if ($errors->has('start_time'))
                            <span class="help-block">{{ $errors->first('start_time') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('end_time') ? 'has-error' : ''}}">
                        <label for="end_time">End Time</label>
                        <input id="end_time" type='text' class="form-control" name="end_time" required value="{{ old('end_time') }}" />
                        @if ($errors->has('end_time'))
                            <span class="help-block">{{ $errors->first('end_time') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('venue') ? 'has-error' : ''}}">
                        <label for="venue">Venue*</label>
                        <input id="venue" type="text" class="form-control" placeholder="Enter Venue" name="venue" required value="{{ old('venue') }}">
                        @if ($errors->has('venue'))
                            <span class="help-block">{{ $errors->first('venue') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('fee') ? 'has-error' : ''}}">
                        <label for="fee">Fee*</label>
                        <input id="fee" type="text" class="form-control" placeholder="Ex 50000 VNĐ" name="fee" required value="{{ old('fee') }}">
                        @if ($errors->has('fee'))
                            <span class="help-block">{{ $errors->first('fee') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('trainer') ? 'has-error' : ''}}">
                        <label for="trainer">Trainer/Speaker*</label>
                        <input id="trainer" type="text" class="form-control" placeholder="Enter Title" name="trainer" required value="{{ old('trainer') }}">
                        @if ($errors->has('trainer'))
                            <span class="help-block">{{ $errors->first('trainer') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('description') ? 'has-error' : ''}}">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Description ...">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('short_content') ? 'has-error' : ''}}">
                        <label for="short_content">Short Content*</label>
                        <textarea name="short_content" id="short_content" class="form-control" rows="3" placeholder="Enter Short Content ...">{{ old('short_content') }}</textarea>
                        @if ($errors->has('short_content'))
                            <span class="help-block">{{ $errors->first('short_content') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('body') ? 'has-error' : ''}}">
                        <label for="body">Body*</label>
                        <textarea name="body" id="body" class="form-control" rows="3" placeholder="Enter Body ...">{{ old('body') }}</textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">{{ $errors->first('body') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="choose_tags">Choose Tags</label>
                        <select id="choose_tags" name="tags[]" class="form-control" multiple="multiple" data-placeholder="Select a Tags" style="width: 100%;">
                        </select>
                    </div>

                    <div class="form-group {{ $errors->first('event_category') ? 'has-error' : ''}}">
                        <label for="choose_category">Choose Categories*</label>
                        <select id="choose_category" name="event_category[]" class="form-control" multiple="multiple" data-placeholder="Select a Category" style="width: 100%;" required>
                            @foreach ($eventsCategory as $eventCategory)
                                <option value="{{ $eventCategory->id }}">{{ $eventCategory->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('event_category'))
                            <span class="help-block">{{ $errors->first('body') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" data-placeholder="Select a Tags" style="width: 100%;" required>
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                        </select>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
    <script src="{{ asset('js/admin/event/create.js') }}"></script>
@endsection
