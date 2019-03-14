@extends('layouts.home.layout')
@section('title','Main Page')
@section('css')
<link type="text/css" rel="stylesheet" href="{{ asset('home/css/slider-main.css') }}" />
@endsection

@section('slide')
<div class="slider-container">
  <div class="slider">
  	@foreach($banners as $banner)
   <div class="slider__item" style="height:450px; width: 800px;">
     <img src="{{ $banner->url }}" alt="" style="height: 100%; width: 100%;">
   </div>
   @endforeach
 </div>
 <div class="slider__switch slider__switch--prev" data-ikslider-dir="prev">
  <span><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 20 20"><path d="M13.89 17.418c.27.272.27.71 0 .98s-.7.27-.968 0l-7.83-7.91c-.268-.27-.268-.706 0-.978l7.83-7.908c.268-.27.7-.27.97 0s.267.71 0 .98L6.75 10l7.14 7.418z"/></svg></span>
</div>
<div class="slider__switch slider__switch--next" data-ikslider-dir="next">
  <span><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 20 20"><path d="M13.25 10L6.11 2.58c-.27-.27-.27-.707 0-.98.267-.27.7-.27.968 0l7.83 7.91c.268.27.268.708 0 .978l-7.83 7.908c-.268.27-.7.27-.97 0s-.267-.707 0-.98L13.25 10z"/></svg></span>
</div>
</div>
@endsection
@section('content')

@endsection
@section('js')
<script src="{{ asset('home/js/slider-main.js') }}"></script>
@endsection
