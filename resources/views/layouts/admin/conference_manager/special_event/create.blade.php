@extends('layouts.admin.conference_layout')
@section('title','Special Event Management')
@section('css')
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Create Special Event</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_special_event_list', ['conference_id' => $conference_id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Special Event List</a>
            </div>
        </div>
        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_special_event_store', ['conference_id' => $conference_id]) }}">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('name') ? 'has-error' : ''}}">
                        <label for="name">Name*</label>
                        <input id="name" type="text" class="form-control" placeholder="Enter name" name="name" required value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('date') ? 'has-error' : ''}}">
                        <label for="date">Date*</label>
                        <input id="date" type='text' class="form-control" name="date" required value="{{ old('date') }}" placeholder="Select Date" />
                        @if ($errors->has('date'))
                            <span class="help-block">{{ $errors->first('date') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('start_time') ? 'has-error' : ''}}">
                        <label for="start_time">Start Time*</label>
                        <input id="start_time" type='text' class="form-control" name="start_time" required value="{{ old('start_time') }}" placeholder="Select Start Time" />
                        @if ($errors->has('start_time'))
                            <span class="help-block">{{ $errors->first('start_time') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('end_time') ? 'has-error' : ''}}">
                        <label for="end_time">End Time*</label>
                        <input id="end_time" type='text' class="form-control" name="end_time" required value="{{ old('end_time') }}" placeholder="Select End Time" />
                        @if ($errors->has('end_time'))
                            <span class="help-block">{{ $errors->first('end_time') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="room_id">Room</label>
                        <select id="room_id" name="room_id" class="form-control" data-placeholder="Select a Tags" style="width: 100%;" data-value="{{ old('room_id') }}">
                            <option value=""></option>
                            @foreach($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }} in {{ $room->building->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group {{ $errors->first('description') ? 'has-error' : ''}}">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5" placeholder="Enter description ...">{{ old('description') }}</textarea>
                        @if ($errors->has('description'))
                            <span class="help-block">{{ $errors->first('description') }}</span>
                        @endif
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
    <script src="{{ asset('js/admin/special_event/create.js') }}"></script>
@endsection
