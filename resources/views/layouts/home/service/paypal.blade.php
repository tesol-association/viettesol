@extends('layouts.home.layout')

@section('css')
    
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h3> If you are on this site, thank you for your generosity. </h3>
        <h3> To donate to us via PayPal, if you have an active PayPal account, do: </h3>
        <div class="col-md-8">
            <fieldset class="form-border">
                <legend class="form-border">{{ __('Click the button below') }}</legend>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                    <input type="hidden" name="cmd" value="_s-xclick" />
                    <input type="hidden" name="hosted_button_id" value="G2QHEN6Q62KQY" />
                    <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
                    <img alt="" border="0" src="https://www.paypal.com/en_VN/i/scr/pixel.gif" width="1" height="1" />
                </form>
            </fieldset>
        </div>

        <div class="col-md-8">
            <fieldset class="form-border">
                <legend class="form-border">{{ __('Or scan this QR Code') }}</legend>
                <img src="{{ asset('home/img/qrcode.png') }}" alt="" style="width: 36%; height: auto;">
            </fieldset>
        </div>
    </div>
</div>
@endsection

@section('js')

@endsection