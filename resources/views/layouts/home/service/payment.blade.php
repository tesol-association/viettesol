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
   
                <form method="post" action="{{ route('home_fee_detail') }}">
                    @csrf
                    <div class="box-body">

                        <div class="form-group">
                            <label for="mscode"> Membership Code:</label>
                            <input id="mscode" type="text" class="form-control" name="mscode" required value="{{ old('mscode')}}">
                            @if ($errors->has('mscode'))
                                <span class="help-block">{{ $errors->first('mscode') }}</span>
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

@endsection