@extends('layouts.admin.layout')
@section('title','Contact Management')

@section('css')

@endsection

@section('page-header')
Create a New Contact
@endsection

@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
		<select>
			
		</select>
	</div>

	<form method="post" action="{{ route('') }}">
		<div class="box-body">
			<div class="form-group">
				<label for="exampleInputEmail1"> First Name: </label>
				<input type="text" class="form-control" placeholder="e.g.: Alexander" name="first_name" required>
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1"> Middle Name: </label>
				<input type="text" class="form-control" name="middle_name">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1"> Last Name: </label>
				<input type="text" class="form-control" placeholder="e.g.: Pierce" name="last_name">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1"> Organization Name: </label>
				<input type="text" class="form-control" placeholder="e.g.: Pierce" name="organization">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1"> Address: </label>
				<input type="text" class="form-control" name="address">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1"> Email: </label>
				<input type="text" class="form-control" name="email">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1"> Phone Number: </label>
				<input type="text" class="form-control" name="phone">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1"> Fax Number: </label>
				<input type="text" class="form-control" name="fax">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1"> Website: </label>
				<input type="text" class="form-control" name="website">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1"> Country: </label>
				<input type="text" class="form-control" name="country">
			</div>

			<div class="form-group">
				<label for="exampleInputEmail1"> Note: </label>
				<input type="text" class="form-control" name="note">
			</div>
		</div>

		<div class="box-footer">
            <button type="submit" class="btn btn-primary"> Create </button>
        </div>
	</form>
</div>
@endsection

@section('js')

@endsection