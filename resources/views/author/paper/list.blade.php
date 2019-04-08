@extends('layouts.admin.conference_layout')
@section('title','Paper Management')
@section('css')
    <link href="{{ asset('js/lib/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="col-md-4">
                            <h3 class="box-title">Paper List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            <a href="{{ route('author_paper_create', ['conference_id' => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Send Paper</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="paper_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Abstract</th>
                                    <th>Track</th>
                                    <th>Status</th>
                                    <th>Author</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Send Full Paper</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($papers as $paper)
                                    <tr>
                                        <td>{{ $paper->id }}</td>
                                        <td>{{ $paper->title }}</td>
                                        <td>{!! $paper->abstract !!}</td>
                                        <td>{{ $paper->track->name }}</td>
                                        <td>{{ $paper->status }}</td>
                                        <td>
                                            @foreach($paper->authors as $author)
                                                @if($author->pivot->seq == Config::get('constants.PAPER_AUTHOR.AUTHOR'))
                                                    <span class="label label-success">{{ $author->first_name }} {{ $author->middle_name }} {{ $author->last_name }}</span>
                                                @else
                                                    <span class="label label-primary">{{ $author->first_name }} {{ $author->middle_name }} {{ $author->last_name }}</span>
                                                @endif
                                            @endforeach
                                            @include('helper.authors.add_coauthor', ['paper' => $paper, 'conference' => $conference, 'name' => ''])
                                        </td>
                                        <td>{{ $paper->created_at }}</td>
                                        <td>
                                            <a href="{{ route('author_paper_edit', ['conference_id' => $conference->id, 'id' => $paper->id]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td>
                                            @if ( $paper->file_id )
                                                <button type="button" data-toggle="modal" data-target="#update_attach_file_{{ $paper->id }}"class="btn btn-success"><i class="fa fa-eye"></i></button>
                                                <div class="modal fade" id="update_attach_file_{{ $paper->id }}" role="dialog">
                                                    <form method="post" action="{{ route('author_paper_file_update', ['conference_id' => $conference->id, 'paper_id' => $paper->id, 'id' => $paper->attachFile->id]) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="box-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h3 class="box-title">Update Attach File</h3>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <div align="center">
                                                                            <h4>You had sent the file</h4>
                                                                            <a target="_blank" href="{{ asset('/storage/' . $paper->attachFile->path) }}" class="btn btn-primary"><span class="fa fa-download"></span> {{ $paper->attachFile->original_file_name }}</a>
                                                                            <h4>If you want to modify the file please select the file and save</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group {{ $errors->first('attach_file') ? 'has-error' : ''}}">
                                                                        <div align="center">
                                                                            <input type="file" id="attach_file" name="attach_file" accept=".doc, .docx, .pptx, .pdf, .ppt, .zip, .rar">
                                                                            @if ($errors->has('attach_file'))
                                                                                <span class="help-block">{{ $errors->first('attach_file') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div>
                                                                            <h4><strong> Full Paper</strong></h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group {{ $errors->first('full_paper') ? 'has-error' : ''}}">
                                                                        <textarea name="full_paper" class="full_paper form-control" rows="3" placeholder="Enter Full Paper ...">{{ $paper->full_paper }}</textarea>
                                                                        @if ($errors->has('full_paper'))
                                                                            <span class="help-block">{{ $errors->first('full_paper') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                        Cancel
                                                                    </button>
                                                                    <button type="submit" class="btn btn-danger">
                                                                        Save
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @else
                                                <button type="button" data-toggle="modal" data-target="#create_attach_file_{{ $paper->id }}"class="btn btn-primary"><i class="fa fa-send-o"></i></button>
                                                <div class="modal fade" id="create_attach_file_{{ $paper->id }}" role="dialog">
                                                    <form method="post" action="{{ route('author_paper_file_store', ['conference_id' => $conference->id, 'paper_id' => $paper->id]) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div class="box-header">
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                        <h3 class="box-title">Add New Attach File</h3>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-group {{ $errors->first('attach_file') ? 'has-error' : ''}}">
                                                                        <div align="center">
                                                                            <h3>Select Attach File</h3>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group {{ $errors->first('attach_file') ? 'has-error' : ''}}">
                                                                        <div align="center">
                                                                            <input type="file" id="attach_file" name="attach_file" accept=".doc, .docx, .pptx, .pdf, .ppt, .zip, .rar">
                                                                            @if ($errors->has('attach_file'))
                                                                                <span class="help-block">{{ $errors->first('attach_file') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div>
                                                                            <h4><strong> Full Paper</strong></h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group {{ $errors->first('full_paper') ? 'has-error' : ''}}">
                                                                        <textarea name="full_paper" class="full_paper form-control" rows="3" placeholder="Enter full_paper ...">{{ $paper->full_paper }}</textarea>
                                                                        @if ($errors->has('full_paper'))
                                                                            <span class="help-block">{{ $errors->first('full_paper') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                        Cancel
                                                                    </button>
                                                                    <button type="submit" class="btn btn-danger">
                                                                        Save
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
@section('js')
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('js/author/list.js') }}"></script>
@endsection
