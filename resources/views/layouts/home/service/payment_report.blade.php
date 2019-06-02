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
                <legend class="form-border">{{ __('Your Payment Info:') }}</legend>
                <div class="box box-primary">
                    <h3> 
                        Hello <i style="color: red;"> {{ $contact->first_name }} {{ $contact->middle_name }} {{ $contact->last_name }} </i>,
                        <br/>
                        Your registered membership was created as a(n) <i style="color: red;"> {{ $contact->membership->msType->name }} </i> Type Membership.
                        <br/>
                        The period of active time is from <i style="color: red;"> {{ $contact->membership->start_date }} </i> to <i style="color: red;"> {{ $contact->membership->end_date }} </i>.
                        <br/>
                        Your maintainance fee is <i style="color: red;"> {{ $fee }} </i>.
                        <br/>
                        Status: 
                        @if( $status == 1 )
                        <i style="color: blue;"> Paid </i>.
                        @else
                        <i style="color: red;"> Not paid </i>. &nbsp;&nbsp;
                        <a class="btn btn-primary" href="{{ route('home_fee_deal', ['id' => $contact->membership->id]) }}"> Pay Now </a>
                        @endif
                    </h3>
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