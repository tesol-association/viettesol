@extends('layouts.admin.layout')
@section('title','User Management')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('page-header')
Create User
@endsection

@section('content')
<section class="content">
    <div class="box box-default">
        <div class="box-body">
            <div class="row">
                <form method="POST" action="{{ route('admin_user_store') }}">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">{{ __('User Name') }}</label>
                            <div>
                                <input id="user_name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" placeholder="Enter user name" value="{{ old('user_name') }}" required>

                                @if ($errors->has('user_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('user_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="first_name">{{ __('First Name') }}</label>
                            <div>
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" placeholder="Enter first name" value="{{ old('first_name') }}" required>

                                @if ($errors->has('first_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="middle_name">{{ __('Middle Name') }}</label>
                            <div>
                                <input id="middle_name" type="text" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name"  placeholder="Enter middle name" value="{{ old('middle_name') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name">{{ __('Last Name') }}</label>
                            <div>
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name"  placeholder="Enter last name" value="{{ old('last_name') }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender">{{ __('Gender') }}</label>
                            <div>
                                <select id="gender" type="text" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" name="gender" value="{{ old('gender') }}">
                                    <option value="Nam">Nam</option>
                                    <option value="Nu">Nu</option>
                                    <option value="Other">Other</option>
                                </select>

                            @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                           <label for="initals">{{ __('Initals') }}</label>
                            <div>
                                <input id="initals" type="text" class="form-control{{ $errors->has('initals') ? ' is-invalid' : '' }}" name="initals"  placeholder="Enter initals" value="{{ old('initals') }}">

                                @if ($errors->has('initals'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('initals') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                           <label for="affiliation">{{ __('Affiliation') }}</label>
                            <div>
                                <input id="affiliation" type="text" class="form-control{{ $errors->has('affiliation') ? ' is-invalid' : '' }}" name="affiliation"  placeholder="Enter affiliation" value="{{ old('affiliation') }}" required>

                                @if ($errors->has('affiliation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('affiliation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_admin">{{ __('Role') }}</label>
                            <div>
                                <select id="is_admin" type="text" class="form-control{{ $errors->has('is_admin') ? ' is-invalid' : '' }}" name="is_admin" value="{{ old('is_admin') }}" required>
                                    <option value="0">No Role</option>
                                    <option value="1">Admin</option>
                                </select>

                            @if ($errors->has('is_admin'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_admin') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="country" >{{ __('Country') }}</label>
                            <div>
                                <select id="country" type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }} selectpicker countrypicker" name="country" value="{{ old('country') }}" data-live-search="true">
                                </select>

                                @if ($errors->has('country'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('country') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <div>
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  placeholder="Enter email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <div>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter password">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">{{ __('Confirm Password') }}</label>
                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  placeholder="Enter repeat password">
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="col-md-2 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Create New User') }}
                            </button>
                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <a href="{{ route('admin_user_list') }}" class="btn btn-primary ">
                                {{ __('Cancel') }}
                            </a>
                        </div>  
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
