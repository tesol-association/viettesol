@extends('layouts.home.layout')

@section('css')
    
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3> New Payment: </h3>
        <div class="col-md-8">
            <fieldset class="form-border">
                <legend class="form-border">{{ __('Your Membership Maintainance Fee:') }}</legend>
                <div class="box box-primary">
   
                <form method="post" action="{{ route('home_fee_done') }}">
                    @csrf
                    <div class="box-body">

                        <h2> Are you sure to make a-{{ $fee }}-USD deal, {{ $member->contact->first_name }}? </h2>

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

@endsection