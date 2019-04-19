@extends('layouts.admin.conference_layout')
@section('title','Registration Conference')
@section('css')

@endsection
@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<h3 class="box-title">Registration Conference</h3>
	</div>
	<!-- /.box-header -->
	<!-- form start -->
	<form method="post" action="{{ route('admin_registration_store',['conference_id'=>$conference->id]) }}" enctype="multipart/form-data">
		@csrf
		<div class="box-body">
			<div class="form-group">
				<label for="exampleInputEmail1">Full name</label>
				<input type="text" class="form-control" name="name"  placeholder="Enter full name" >
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">organization</label>
				<input type="text" class="form-control" name="organization"  placeholder="Enter organization">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">email</label>
				<input type="email" class="form-control" name="email"  placeholder="Enter email">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">Phone</label>
				<input type="text" class="form-control" name="phone"  placeholder="Enter phone">
			</div>
			<div class="form-group">
				<label for="exampleInputFile">Payment file</label>
				<input type="file" id="exampleInputFile" name="payment_file">
			</div>
			<div class="form-group">
				<label for="exampleInputEmail1">affiliation</label>
				<input type="text" class="form-control" name="affiliation"  placeholder="Enter affiliation">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1">role</label>
				<select name="role_id" class="form-control">
					<option>Select role</option>
					@foreach($roles as $role)
					@if($role->name == 'author' || $role->name == 'reviewer')
					<option value="{{ $role->id }}">{{ $role->name }}</option>
					@endif
					@endforeach
				</select>
			</div>
			<input type="hidden" name="status" value="{{ 'pending' }}">
			<input type="hidden" name="user_id" value="{{ Auth::User()->id }}">
			<input type="hidden" name="conference_id" value="{{ $conference->id }}">
		</div>
		<!-- /.box-body -->

		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Submit</button>
		</div>
	</form>
</div>
@endsection
@section('js')

@endsection