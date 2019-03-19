@extends('layouts.admin.layout')
@section('title','Membership Management')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
<link rel="stylesheet" href="{{ asset('admin/bower_components/select2/dist/css/select2.css') }}">
<link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('page-header')
Add a New Member
@endsection

@section('content')
<div class="box box-primary">
    <div class="box-header with-border">
        <div class="col-md-4">
                <h3 class="box-title">Add a new Member</h3>
        </div>
        <div class="col-md-2 col-md-offset-6">
            <a href="{{ route('admin_membership_list') }}" class="btn btn-block btn-info">
                Member List
            </a>
        </div>
    </div>
    <form method="post" action="{{ route('admin_membership_store') }}">
        @csrf
        <div class="box-body">

            <div class="form-group">
                <label> Contact ID*: </label>
                <select class="form-control" name="contact_id">
                    @foreach( $contacts as $contact )
                        @if( $contact->membership == null )
                            @if( $contact->contactType->name === "Individual" )
                            <option value="{{ $contact->id }}"> {{ $contact->id }} : {{ $contact->first_name." ".$contact->middle_name." ".$contact->last_name }} </option>
                            @else
                            <option value="{{ $contact->id }}"> {{ $contact->id }} : {{ $contact->organize_name }} </option>
                            @endif
                        @endif
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label> Membership Type*: </label>
                <select class="form-control" name="type_id">
                    @foreach( $memberTypes as $type )
                        <option value="{{ $type->id }}"> {{ $type->name }} </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">

                <table style="width: 100%">
                    <tr>
                        <td style="width:30%"> <label for="start_date"> Start Date*: </label> </td>
                        <td> 
                            <input name="start_date" type="text" class="datepicker {{ $errors->has('start_date') ? 'has-error' : '' }}" id="start_date"> 
                            @if ($errors->has('start_date'))
                            <span class="help-block">{{ $errors->first('start_date') }}</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <i> This field indicates the start date of this member's new Membership Terms. </i>

                
                <table style="width: 100%">
                    <tr>
                        <td style="width:30%"> <label for="end_date"> End Date*: </label> </td>
                        <td> 
                            <input name="end_date" type="text" class="datepicker {{ $errors->has('end_date') ? 'has-error' : '' }}" id="end_date"> 
                            @if ($errors->has('end_date'))
                            <span class="help-block">{{ $errors->first('end_date') }}</span>
                            @endif
                        </td>
                    </tr>
                </table>

                <i> This field indicates the end date of this member's new Membership Terms. </i>
                

            </div>

        </div>
                        
        <div class="box-footer">
            <button type="submit" class="btn btn-primary"> Create </button>
        </div>
    </form>
</div>
@endsection

@section('js')
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