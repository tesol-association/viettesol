@extends('layouts.admin.conference_layout')
@section('title','Update Timeblock')
@section('css')
<link href="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Edit timeblock</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form method="post" action="{{ route('admin_time_block_update',["conference_id" => $conference->id,"id" => $timeBlock->id]) }}">
		@csrf
		<div class="box-body">
			<div class="form-group">
				<label for="date">Date*</label>
				<input id="date" type='text' class="form-control" name="date" required value="{{ $timeBlock->date }}" />
			</div>
			<div class="form-group">
				<label for="start_time">Start Time*</label>
				<input id="start_time" type='text' class="form-control" name="start_time" required value="{{ $timeBlock->start_time }}" />
			</div>
			<div class="form-group">
				<label for="end_time">End Time*</label>
				<input id="end_time" type='text' class="form-control" name="end_time" required value="{{ $timeBlock->end_time }}" />
			</div>

		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Update</button>
		</div>
	</form>
</div>
@endsection
@section('js')
<script src="{{ asset('admin/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('js/admin/time_block/create.js') }}"></script>
@endsection