@extends('layouts.admin.layout')
@section('title','Partner-Sponsor Management')
@section('css')

@endsection
@section('page-header')
Update partner/sponsor
@endsection
@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="post" action="{{ route('admin_partner_update',['id'=>$partner->id]) }}" enctype="multipart/form-data">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ $partner->name }}" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <input type="text" class="form-control" placeholder="Enter title" name="description" value="{{ $partner->description }}" >
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Logo</label>
                  <input type="file" class="form-control" placeholder="Enter logo" name="upload_file" value="{{ $partner->logo }}" required>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Type</label>
                  <select class="form-control" name="type">
                    <option value="partner" @if($partner->type == 'partner') {{ 'selected' }} @endif>partner</option>
                    <option value="sponsor" @if($partner->type == 'sponsor') {{ 'selected' }} @endif>sponsor</option>
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