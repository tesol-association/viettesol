@extends('layouts.admin.layout')
@section('title','News Management')
@section('css')
    <link href="{{ asset('js/lib/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box">
        <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Edit New</h3>
            <div class="box-tools pull-right">
                <a href="{{ route('admin_news_list') }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> News List</a>
            </div>
        </div>
        <div class="box-body">
            <!-- form start -->
            <form  method="post" action="{{ route('admin_news_update', ["id" => $new->id]) }}">
                @csrf
                <div class="box-body">
                    <div class="form-group {{ $errors->first('title') ? 'has-error' : ''}}">
                        <label for="title">Title*</label>
                        <input id="title" type="text" class="form-control" placeholder="Enter Title" name="title" required value="{{ $new->title }}">
                        @if ($errors->has('title'))
                            <span class="help-block">{{ $errors->first('title') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('slug') ? 'has-error' : ''}}">
                        <label for="slug">Slug*</label>
                        <input id="slug" type="text" class="form-control" placeholder="Enter Title" name="slug" required value="{{ $new->slug }}">
                        @if ($errors->has('slug'))
                            <span class="help-block">{{ $errors->first('slug') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('short_content') ? 'has-error' : ''}}">
                        <label for="short_content">Short Content*</label>
                        <textarea name="short_content" id="short_content" class="form-control" rows="3" placeholder="Enter Short Content ...">{!! $new->short_content !!}</textarea>
                        @if ($errors->has('short_content'))
                            <span class="help-block">{{ $errors->first('short_content') }}</span>
                        @endif
                    </div>

                    <div class="form-group {{ $errors->first('body') ? 'has-error' : ''}}">
                        <label for="body">Body*</label>
                        <textarea name="body" id="body" class="form-control" rows="3" placeholder="Enter Body ...">{!! $new->body !!}</textarea>
                        @if ($errors->has('body'))
                            <span class="help-block">{{ $errors->first('body') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="choose_tags">Choose Tags</label>
                        <select id="choose_tags" name="tags[]" class="form-control" multiple="multiple" data-placeholder="Select a Tags" style="width: 100%;">
                            @if (isset($new->tags) && count($new->tags))
                                @foreach($new->tags as $tag)
                                    <option value="{{ $tag }}" selected>{{ $tag }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    <div class="form-group {{ $errors->first('news_category') ? 'has-error' : ''}}">
                        <label for="choose_category">Choose Categories*</label>
                        <select id="choose_category" name="news_category[]" class="form-control" multiple="multiple" data-placeholder="Select a Category" style="width: 100%;" required>
                            @foreach ($newsCategory as $newCategory)
                                @if (in_array($newCategory->id, $new->categories))
                                    <option value="{{ $newCategory->id }}" selected>{{ $newCategory->name }}</option>
                                @else
                                    <option value="{{ $newCategory->id }}">{{ $newCategory->name }}</option>
                                @endif
                            @endforeach
                        </select>
                        @if ($errors->has('news_category'))
                            <span class="help-block">{{ $errors->first('body') }}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" data-placeholder="Select a Tags" style="width: 100%;" required>
                            @if ($new->status = 'draft')
                                <option value="draft" selected>Draft</option>
                                <option value="published">Published</option>
                            @elseif ($new->status = 'published')
                                <option value="draft">Draft</option>
                                <option value="published" selected>Published</option>
                            @endif
                        </select>
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/admin/news/create.js') }}"></script>
@endsection
