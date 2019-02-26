@extends('layouts.admin.layout')
@section('title','Menu Management')
@section('css')

@endsection
@section('page-header')
Update menu
@endsection
@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="post" action="{{ route('admin_menu_update',['id'=>$menu->id]) }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Name</label>
                  <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ $menu->name }}" required>
                </div>
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Url</label>
                  <input type="text" class="form-control" placeholder="Enter url" name="url" value="{{ $menu->url }}">
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Description</label>
                  <input type="text" class="form-control" placeholder="Enter description" name="description" value="{{ $menu->description }}" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">created_by</label>
                  <input type="text" class="form-control" placeholder="Enter creator" name="creator_id" value="{{ $menu->created_by }}" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">parent_id</label>
                  <input type="text" class="form-control" placeholder="Enter parent" name="parent_id" value="{{ $menu->parent_id }}">
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