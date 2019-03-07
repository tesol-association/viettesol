@extends('layouts.admin.layout')
@section('title','Submenu Management')
@section('css')

@endsection
@section('page-header')
Create submenu
@endsection
@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="post" action="{{ route('admin_submenu_add') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" placeholder="Enter name" name="name" required>
                </div>
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Url</label>
                  <input type="text" class="form-control" placeholder="Enter url" name="url">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <input type="text" class="form-control" placeholder="Enter description" name="description" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">created_by</label>
                  <input type="text" class="form-control" placeholder="Enter creator"  value="{{Auth::User()->user_name}}" required disabled>
                  <input type="hidden" name="created_by" value="{{Auth::User()->id}}">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">parent_id</label>
                  <select class="form-control" name="parent_id">
                      <option value="{{ $menu[0]->id }}">{{ $menu[0]->name }}</option>
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