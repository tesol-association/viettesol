@extends('layouts.home.layout')
@section('title','Event registration')
@section('css')
<link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
@endsection
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h3>Registration</h3>
		<h3 class="box-title">{{ $event->title }}</h3>
		<p>{!! $event->short_content !!}</p>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form method="post" action="{{ route('store-register') }}">
		@csrf
		<div class="box-body">

			<div class="form-group">
				<label for="exampleInputEmail1">Full name *</label>
				<input type="text" class="form-control" name="full_name" placeholder="Enter name" value="@if(!empty(Auth::id())) {{  Auth::User()->first_name.' '.Auth::User()->middle_name.' '.Auth::User()->last_name }} @else @endif">
			</div>
			<div class="form-group">
				<label>Select gender</label>
				<select class="form-control" name="gender">
					<option value="">Gender</option>
					<option value="1">Male</option>
					<option value="0">Female</option>
				</select>
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Affiliation *</label>
				<input type="text" class="form-control" name="affiliation" placeholder="Enter affiliation" value="@if(!empty(Auth::id())) {{  Auth::User()->affiliation }} @else @endif">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Department</label>
				<input type="text" class="form-control" name="department" placeholder="Enter department">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Position at work</label>
				<input type="text" class="form-control" name="position" placeholder="Enter position">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Address</label>
				<input type="text" class="form-control" name="address" placeholder="Enter address">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Email *</label>
				<input type="email" class="form-control" name="email" placeholder="Enter email" value="@if(!empty(Auth::id())) {{  Auth::User()->email }} @else @endif">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Phone</label>
				<input type="text" class="form-control" name="phone" placeholder="Enter phone" value="@if(!empty(Auth::id())) {{  Auth::User()->phone }} @else @endif">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Highest degree</label>
				<input type="text" class="form-control" name="highest_degree" placeholder="Enter highest degree">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Email notify</label>
				<input type="email" class="form-control" name="email_notify" placeholder="Enter email notify" value="@if(!empty(Auth::id())) {{  Auth::User()->email }} @else @endif">
			</div>
			<div class="form-group">
				<input type="hidden" class="form-control" name="event_id" value="{{ $event->id }}">
			</div>
			@if(!empty($criteriaOthers))
			@foreach($criteriaOthers as $criteriaOther)
			@if($criteriaOther['type'] == 1)
			<div class="form-group">
				<label for="exampleInputEmail1">{{ $criteriaOther['name'] }}</label>
				<input type="text" class="form-control" name="criteriaText[]" placeholder="" value="">
			</div>
			@endif
			@if($criteriaOther['type'] == 2)
			<div class="form-group">
				<label>{{ $criteriaOther['name'] }}</label>
				<select class="form-control" name="criteriaSelect[]">
					@foreach($criteriaOther['possible_values'] as $key => $value)
					<option value="{{ $value }}">{{ $value }}</option>
					@endforeach
				</select>
			</div>
			@endif
			@if($criteriaOther['type'] == 3)
			<div class="form-group">
				<label for="exampleInputEmail1">{{ $criteriaOther['name'] }}</label>
				@foreach($criteriaOther['possible_values'] as $criteria)
				<div class="radio">
					<label>
						<input type="radio" name="criteriaRadio[]" value="{{ $criteria }}">
						{{ $criteria }}
					</label>
				</div>
				@endforeach
			</div>
			@endif
			@endforeach
			@endif

		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
</div>
@endsection
@section('js')
<script src="{{ asset('js/lib/toastr.min.js') }}"></script>
<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
     <script>
     	@if(Session::has('success'))
     	toastr.success('{{ Session::get("success") }}');
     	@endif
     	@if(Session::has('error'))
     	toastr.error('{{ Session::get("error") }}');
     	@endif
     	@if($errors->any())
     	@foreach($errors->all() as $error)
     	toastr.error('{{ $error }}');
     	@endforeach
     	@endif
     </script>
     @endsection