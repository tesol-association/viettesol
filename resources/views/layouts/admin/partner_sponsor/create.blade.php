@extends('layouts.admin.layout')
@section('title','Banner Management')
@section('css')

@endsection
@section('page-header')
Create partner/sponsor
@endsection
@section('content')
<div class="box box-primary">
            
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="{{ route('admin_partner_store') }}" enctype="multipart/form-data">
              <div class="box-body">
              	<input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" name="name" placeholder="Enter name" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <input type="text" class="form-control" name="description" placeholder="Enter description" >
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Logo</label>
                  <input type="file" class="form-control" name="upload_file" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Type</label>
                  <select class="form-control" name="type">
                  	<option value="">Select type</option>
                    <option value="partner">Partner</option>
                    <option value="sponsor">Sponsor</option>
                  </select>
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