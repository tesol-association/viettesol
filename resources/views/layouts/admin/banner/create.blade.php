@extends('layouts.admin.layout')
@section('title','Banner Management')
@section('css')

@endsection
@section('page-header')
Create banner
@endsection
@section('content')
<div class="box box-primary">
  
  <!-- /.box-header -->
  <!-- form start -->
  <form method="post" action="{{ route('admin_banner_store') }}" enctype="multipart/form-data">
    <div class="box-body">
     <input type="hidden" name="_token" value="{{ csrf_token() }}">
     <div class="form-group">
      <label for="exampleInputEmail1">Title</label>
      <input type="text" class="form-control" name="title" placeholder="Enter name" required>
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Url</label>
      <input type="file" class="form-control" name="upload_file" required>
    </div>
  </div>
  <!-- /.box-body -->

  <div class="box-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>
</div>
@endsection
@section('js')

@endsection