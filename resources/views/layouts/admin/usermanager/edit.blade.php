@extends('layouts.admin.layout')
@section('title','User Management')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('page-header')
Update User
@endsection

@section('content')
<section class="content">
    <div class="box box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Data User</h3>  
        </div>
        <div class="box-body">
            <div class="row">
                <form method="POST" action="{{ route('admin_user_update',['id'=> $users->id ]) }}">
                    @csrf
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="name">{{ __('User Name') }}</label>
                            <div>
                                <input id="user_name" type="text" class="form-control{{ $errors->has('user_name') ? ' is-invalid' : '' }}" name="user_name" placeholder="Enter user name" value="{{ $users->user_name }}" required>

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
                                <input id="first_name" type="text" class="form-control{{ $errors->has('first_name') ? ' is-invalid' : '' }}" name="first_name" placeholder="Enter first name" value="{{ $users->first_name }}" required>

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
                                <input id="middle_name" type="text" class="form-control{{ $errors->has('middle_name') ? ' is-invalid' : '' }}" name="middle_name"  placeholder="Enter middle name" value="{{ $users->middle_name }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="last_name">{{ __('Last Name') }}</label>
                            <div>
                                <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name"  placeholder="Enter last name" value="{{ $users->last_name }}" required>

                                @if ($errors->has('last_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                           <label for="initals">{{ __('Initals') }}</label>
                            <div>
                                <input id="initals" type="text" class="form-control{{ $errors->has('initals') ? ' is-invalid' : '' }}" name="initals"  placeholder="Enter initals" value="{{ $users->initals }}">

                                @if ($errors->has('initals'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('initals') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gender">{{ __('Gender') }}</label>
                            <div>
                                <select id="gender" type="text" class="form-control{{ $errors->has('gender') ? 'is-invalid' : '' }}" name="gender">
                                    <option value="male" {{ $users->gender == 'male' ? 'selected' : '' }}>male</option>
                                    <option value="female" {{ $users->gender == 'female' ? 'selected' : '' }}>female</option>
                                    <option value="other" {{ $users->gender == 'other' ? 'selected' : '' }}>Other</option>
                                </select>

                            @if ($errors->has('gender'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('gender') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                           <label for="affiliation">{{ __('Affiliation') }}</label>
                            <div>
                                <input id="affiliation" type="text" class="form-control{{ $errors->has('affiliation') ? ' is-invalid' : '' }}" name="affiliation"  placeholder="Enter affiliation" value="{{ $users->affiliation }}" required>

                                @if ($errors->has('affiliation'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('affiliation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="form-group">
                            <label for="is_admin">{{ __('Role') }}</label>
                            <div>
                                <select id="is_admin" type="text" class="form-control{{ $errors->has('is_admin') ? ' is-invalid' : '' }}" name="is_admin">
                                    <option value="0" {{ $users->is_admin == '0' ? 'selected' : '' }}>No Role</option>
                                    <option value="1" {{ $users->is_admin == '1' ? 'selected' : '' }}>Admin</option>
                                </select>

                            @if ($errors->has('is_admin'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('is_admin') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="role_id" >{{ __('Permission') }}</label>
                            <div>
                                <select id="role_id" type="text" class="form-control{{ $errors->has('role_id') ? ' is-invalid' : '' }}" name="role_id" value="{{ $users->role_id }}">
                                    <option></option>
                                </select>

                                @if ($errors->has('role_id'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('role_id') }}</strong>
                                </span>
                            @endif
                            </div>
                        </div>

                        <div class="form-group">
                           <label for="phone">{{ __('Phone') }}</label>
                            <div>
                                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone"  placeholder="Enter Phone" value="{{ $users->phone }}">

                                @if ($errors->has('phone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                           <label for="fax">{{ __('Fax') }}</label>
                            <div>
                                <input id="fax" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="fax"  placeholder="Enter Fax" value="{{ $users->fax }}">

                                @if ($errors->has('fax'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="country" >{{ __('Country') }}</label>
                            <div>
                                <select id="country" type="text" class="form-control{{ $errors->has('country') ? ' is-invalid' : '' }}" name="country" value="{{ $users->country }}">
                                    <option value="Albania" {{ $users->country == 'Albania' ? 'selected' : '' }}>Albania</option>
                                    <option value="Afghanistan" {{ $users->country == 'Afghanistan' ? 'selected' : '' }}>Afghanistan</option>
                                    <option value="Algeria" {{ $users->country == 'Algeria' ? 'selected' : '' }}>Algeria</option>
                                    <option value="Andorra" {{ $users->country == 'Andorra' ? 'selected' : '' }}>Andorra</option>
                                    <option value="Angola" {{ $users->country == 'Angola' ? 'selected' : '' }}>Angola</option>
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
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email"  placeholder="Enter email" value="{{ $users->email }}" required>

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
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="Enter password" value="{{ $users->password }}">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="box-footer">
                        <div class="col-md-2 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Update') }}
                            </button>
                        </div>
                        <div class="col-md-2 col-md-offset-1">
                            <a href="{{ route('admin_user_list') }}" class="btn btn-primary">
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
