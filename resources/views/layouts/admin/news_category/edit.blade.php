@extends('layouts.admin.layout')
@section('title','News Management')
@section('css')
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Edit Category For News</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_news_category_list') }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> News Category List</a>
            </div>
        </div>
        <!-- form start -->
        <form  method="post" action="{{ route('admin_news_category_update', ['id' => $newCategory->id]) }}">
            @csrf
            <div class="box-body">
                <div class="form-group {{ $errors->first('name') ? 'has-error' : ''}}">
                    <label class="control-label" for="name">Name*</label>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Enter ..." value="{{ $newCategory->name }}" required>
                    @if ($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control" rows="3" placeholder="Enter Body ...">{{ $newCategory->description }}</textarea>
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
