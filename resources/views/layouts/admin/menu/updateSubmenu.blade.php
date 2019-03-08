@extends('layouts.admin.layout')
@section('title','Submenu Management')
@section('css')

@endsection
@section('page-header')
Update submenu
@endsection
@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="post" action="{{ route('admin_submenu_update',['id'=>$submenu->id]) }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ $submenu->name }}" required>
                </div>
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Url</label>
                  <input type="text" class="form-control" placeholder="Enter url" name="url" value="{{ $submenu->url }}">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <input type="text" class="form-control" placeholder="Enter description" name="description" value="{{ $submenu->description }}" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">parent_id</label>
                  <select class="form-control" name="parent_id">
                    <option value="">Select menu</option>
                    @foreach($parents as $parent)
                      <option value="{{ $parent->id }}" @if($parent->id == $submenu->parent_id) {{'selected'}} @endif >{{ $parent->name }}</option>
                    @endforeach
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