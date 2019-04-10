@extends('layouts.admin.conference_layout')
@section('title','Create Fee')
@section('css')
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Create Fee</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_fee_list', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Fee List</a>
            </div>
        </div>

        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_fee_store', ["conference_id" => $conference->id]) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="conference_id" value="{{ $conference->id }}">
                <div class="form-group {{ $errors->first('time') ? 'has-error' : ''}}">
                    <label for="time">Time *</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input id="time" type='text' class="form-control" name="time" required value="{{ old('time') }}" />
                    </div>
                    @if ($errors->has('time'))
                        <span class="help-block">{{ $errors->first('time') }}</span>
                    @endif
                </div>
                <div class="results"></div>
                <div class="form-category">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Fee For Category</h3>
                            <div class="box-tools pull-right">
                                <a class="add_category btn btn-box-tool btn-primary"><i class="fa fa-plus"></i></a>
                                <a class="remove_category btn btn-box-tool btn-danger"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="box-body no-padding">
                            <div class="form-group {{ $errors->first('category') ? 'has-error' : ''}}">
                                <label for="category">Category *</label>
                                <input id="category" class="form-control" placeholder="Enter Category" name="category[]" value="{{ old('category') }}" required>
                                @if ($errors->has('category'))
                                    <span class="help-block">{{ $errors->first('category') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->first('price_before_time') ? 'has-error' : ''}}">
                                <label for="price_before_time">Price Before Time*</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="price_before_time" name="price_before_time[]" placeholder="Enter Price Before Time" value="{{ old('price_before_time') }}" required>
                                    <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                </div>
                                @if ($errors->has('price_before_time'))
                                    <span class="help-block">{{ $errors->first('price_before_time') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->first('price_after_time') ? 'has-error' : ''}}">
                                <label for="price_after_time">Price After Time*</label>
                                <div class="input-group">
                                    <input class="form-control" type="text" id="price_after_time" name="price_after_time[]" placeholder="Enter Price After Time" value="{{ old('price_after_time') }}" required>
                                    <div class="input-group-addon"><i class="fa fa-usd"></i></div>
                                </div>
                                @if ($errors->has('price_after_time'))
                                    <span class="help-block">{{ $errors->first('price_after_time') }}</span>
                                @endif
                            </div>

                            <div class="form-group {{ $errors->first('description') ? 'has-error' : ''}}">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description[]" rows="6" placeholder="Enter discription for Fee"></textarea>
                                @if ($errors->has('description'))
                                    <span class="help-block">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </form>
            <!-- form end -->
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('admin/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/admin/fee/create.js') }}"></script>
@endsection
