@extends('layouts.admin.layout')
@section('title','Menu Management')
@section('css')

@endsection
@section('page-header')
Create menu
@endsection
@section('content')
<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form  method="post" action="{{ route('admin_menu_store') }}">
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
                  <input type="text" class="form-control" placeholder="Enter creator" name="creator_id" value="{{Auth::User()->id}}" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">parent_id</label>
                  <select class="form-control" name="parent_id">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                  <!-- <input type="text" class="form-control" placeholder="Enter parent" name="parent_id"> -->
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