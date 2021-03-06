@extends('layouts.admin.layout')
@section('title','Contact Management')

@section('css')
<link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page-header')
Edit an existing Contact
@endsection

@section('content')
<div class="box box-primary">
	<div class="box-header with-border">
        <div class="col-md-4">
                <h3 class="box-title">Edit this Contact</h3>
        </div>
        <div class="col-md-2 col-md-offset-6">
            <a href="{{ route('admin_contact_list') }}" class="btn btn-block btn-info">
                Contact List
            </a>
        </div>
    </div>

	<form method="post" action="{{ route('admin_contact_update', ["id" => $contact->id]) }}" id="form_ind">
		@csrf
		<div class="box-body">
			<div class="form-group">
				<label for="type_id"> Contact Type*: </label>
				<select class="form-control" name="type_id" id="type_id" onselect="change(this)" >
					@foreach( $contactTypes as $contactType )
						@if ($contactType->id == $contact->contactType->id)
							<option value="{{ $contactType->id }}" selected> {{ $contactType->name }} </option>
						@else
							<option value="{{ $contactType->id }}"> {{ $contactType->name }} </option>
						@endif
					@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="first_name"> First Name: </label>
				<input type="text" class="form-control" placeholder="e.g.: Alexander" name="first_name" id="first_name" value="{{ $contact->first_name }}">
			</div>

			<div class="form-group">
				<label for="middle_name"> Middle Name: </label>
				<input type="text" class="form-control" name="middle_name" id="middle_name" value="{{ $contact->middle_name }}">
			</div>

			<div class="form-group">
				<label for="last_name"> Last Name: </label>
				<input type="text" class="form-control" placeholder="e.g.: Pierce" name="last_name" id="last_name" value="{{ $contact->last_name }}">
			</div>

			<div class="form-group">
				<label for="organize_name"> Organization Name: </label>
				<input type="text" class="form-control" placeholder="e.g.: Pierce" name="organize_name" id="organize_name" value="{{ $contact->organize_name }}">
			</div>

			<div class="form-group">
				<label for="address"> Address: </label>
				<input type="text" class="form-control" name="address" id="address" value="{{ $contact->address }}">
			</div>

			<div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
				<label for="email"> Email*: </label>
				<input type="text" class="form-control" name="email" id="email" value="{{ $contact->email }}">
				@if ($errors->has('email'))
                    <span class="help-block">{{ $errors->first('email') }}</span>
                @endif
			</div>

			<div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
				<label for="phone"> Phone Number*: </label>
				<input type="text" class="form-control" name="phone" id="phone" value="{{ $contact->phone }}">
				@if ($errors->has('phone'))
                    <span class="help-block">{{ $errors->first('phone') }}</span>
                @endif
			</div>

			<div class="form-group">
				<label for="fax"> Fax Number: </label>
				<input type="text" class="form-control" name="fax" id="fax" value="{{ $contact->fax }}">
			</div>

			<div class="form-group">
				<label for="website"> Website: </label>
				<input type="text" class="form-control" name="website" id="website" value="{{ $contact->website }}">
			</div>

			<div class="form-group">
				<label for="country"> Country: </label>
				<select class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" id="country" name="country" data-value="{{ $contact->country }}">
					@include('helper.country')
                </select>

                @if ($errors->has('country'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('country') }}</strong>
                    </span>
                @endif
			</div>

			<div class="form-group">
				<label for="note"> Note: </label>
				<textarea id="note"  class="form-control" rows="3" placeholder="Other info ..." name="note"> {{ $contact->note }} </textarea>
			</div>
		</div>

		<div class="box-footer">
            <button type="submit" class="btn btn-primary"> Update </button>
        </div>
	</form>
</div>
@endsection

@section('js')
<script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#country').select2();
        var countrySelected = $('#country').data('value');
        $('#country').val(countrySelected).trigger('change');
    });
</script>

@endsection