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
                        Payment Status:
                        <br>
                        {{ $paymentStatus }}
                        <br>
                        Checkout Url:
                        <br>
                        {{ $checkoutUrl }}
                        <br>
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