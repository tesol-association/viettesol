@extends('layouts.home.layout')

@section('css')
<link href="{{ asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}"  rel="stylesheet">
<link href="{{ asset('admin/bower_components/select2/dist/css/select2.css') }}" rel="stylesheet" >
<link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3> New Membership: </h3>
        <div class="col-md-8">
            <fieldset class="form-border">
                <legend class="form-border">{{ __('Your Membership Info:') }}</legend>
                <div class="box box-primary">
   
                <form method="post" action="{{ route('home_member_save') }}">
                    @csrf
                    <div class="box-body">

                        <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                            <label for="first_name"> First Name*: </label>
                            <input id="first_name" type="text" class="form-control" name="first_name" required value="{{ old('first_name')}}">
                            @if ($errors->has('first_name'))
                                <span class="help-block">{{ $errors->first('first_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('middle_name') ? 'has-error' : '' }}">
                            <label for="middle_name"> Middle Name*: </label>
                            <input id="middle_name" type="text" class="form-control" name="middle_name" required value="{{ old('middle_name')}}">
                            @if ($errors->has('middle_name'))
                                <span class="help-block">{{ $errors->first('middle_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                            <label for="last_name"> First Name*: </label>
                            <input id="last_name" type="text" class="form-control" name="last_name" required value="{{ old('last_name')}}">
                            @if ($errors->has('last_name'))
                                <span class="help-block">{{ $errors->first('last_name') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email"> Email*: </label>
                            <input id="email" type="text" class="form-control" name="email" required value="{{ old('email')}}">
                            @if ($errors->has('email'))
                                <span class="help-block">{{ $errors->first('email') }}</span>
                            @endif
                        </div>

                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                            <label for="address"> Address: </label>
                            <input id="address" type="text" class="form-control" name="address" value="{{ old('address')}}">
                        </div>

                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                            <label for="phone"> Phone: </label>
                            <input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone')}}">
                        </div>

                        <div class="form-group {{ $errors->has('fax') ? 'has-error' : '' }}">
                            <label for="fax"> Fax: </label>
                            <input id="fax" type="text" class="form-control" name="fax" value="{{ old('fax')}}">
                        </div>

                        <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                            <label for="website"> Website: </label>
                            <input id="website" type="text" class="form-control" name="website" value="{{ old('website')}}">
                        </div>

                        <div class="form-group">
                            <label for="country"> Country: </label>
                            <select class="form-control {{ $errors->has('country') ? ' is-invalid' : '' }}" id="country" name="country" data-value="{{ old('country') }}">
                                @include('helper.country')
                            </select>

                            @if ($errors->has('country'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="payfor"> Membership Type*:</label>
                            <select class="form-control" name="payfor">
                            @foreach( $msTypes as $type )
                            <option value="{{ $type->id }}"> {{ $type->name }} </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form=group">
                            <label for="end_date"> Due Date*:</label>
                            <input name="end_date" type="text" class="datepicker {{ $errors->has('end_date') ? 'has-error' : '' }}" id="end_date"> 
                            @if ($errors->has('end_date'))
                            <span class="help-block">{{ $errors->first('end_date') }}</span>
                            @endif
                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary"> Submit </button>
                        </div>
                    </div>

                </form>

                </div>
            </fieldset>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#country').select2();
        var countrySelected = $('#country').data('value');
        $('#country').val(countrySelected).trigger('change');
    }); 
</script>
<script src="{{ asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            autoclose: true,
            'format': 'yyyy/mm/dd',
        })
    });
</script>
@endsection