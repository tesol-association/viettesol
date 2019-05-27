@extends('layouts.admin.conference_layout')
@section('title','Edit Paper')
@section('css')
    <link href="{{ asset('js/lib/summernote/dist/summernote.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">AUTHOR</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div class="box-body">
            <div class="table-responsive">
                <table id="author_list" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Affiliation</th>
                            <th>Site URL</th>
                            <th>Email</th>
                            <th>Country</th>
                            <th>Type</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($paper->authors as $author)
                        <tr>
                            <td>{{ $author->id }}</td>
                            <td>{{ $author->first_name }} {{ $author->middle_name }} {{ $author->last_name }}</td>
                            <td>{{ $author->affiliation }}</td>
                            <td>{{ $author->site_url }}</td>
                            <td>{{ $author->email }}</td>
                            <td>{{ $author->country }}</td>
                            <td>
                                @if($author->pivot->seq == Config::get('constants.PAPER_AUTHOR.AUTHOR'))
                                    <span class="label label-success">AUTHOR</span>
                                @else
                                    <span class="label label-primary">CO-AUTHOR</span>
                                @endif
                            </td>
                            <td>
                                @include('helper.authors.edit_author', ['author' => $author, 'paper' => $paper, 'conference' => $conference, 'name' => ''])
                            </td>
                            <td>
                                @if($author->pivot->seq == Config::get('constants.PAPER_AUTHOR.AUTHOR'))
                                    <button type="button" class="btn btn-danger fa fa-trash" data-toggle="modal" data-target="#delete_author_{{ $author->id }}_of_paper" disabled></button>
                                @else
                                    <button type="button" class="btn btn-danger fa fa-trash" data-toggle="modal" data-target="#delete_author_{{ $author->id }}_of_paper"></button>
                                @endif
                                <div class="modal fade" id="delete_author_{{ $author->id }}_of_paper" role="dialog">
                                    <form method="post" action="{{ route('author_of_paper_delete', [ "conference_id" => $conference->id, 'id' => $paper->id, 'author_id'=> $author->id ]) }}">
                                        @csrf
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Are you sure delete: {{ $author->first_name }} {{ $author->middle_name }} {{ $author->last_name }} of {{ $paper->title }}?</h4>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @include('helper.authors.add_coauthor', ['paper' => $paper, 'conference' => $conference, 'name' => ' Add Co-Author For Paper'])
        </div>
    </div>
<form method="POST" action="{{ route('author_paper_update', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">
    @csrf
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">TRACK AND SESSION TYPE</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="" data-original-title="Collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
        </div>

        <div class="box-body">
            <div class="form-group {{ $errors->first('track_id') ? 'has-error' : ''}}">
                <label for="track_id">Track :</label>
                <p>{{ $paper->track->name }}</p>
            </div>
            <div class="form-group {{ $errors->first('session_type_id') ? 'has-error' : ''}}">
                <label for="session_type_id">Session Type :</label>
                <p>{{ $paper->sessionType->name }}</p>
            </div>
        </div>
        <div class="box-header">
            <h3 class="box-title">TITLE AND ABSTRACT</h3>
        </div>
        <div class="box-body">
            <div class="form-group {{ $errors->first('title') ? 'has-error' : ''}}">
                <label for="title">Title*</label>
                <input id="title" type="text" class="form-control" name="paper[title]" required value="{{ $paper->title }}">
                @if ($errors->has('title'))
                    <span class="help-block">{{ $errors->first('title') }}</span>
                @endif
            </div>

            <div class="form-group {{ $errors->first('abstract') ? 'has-error' : ''}}">
                <label for="abstract">Abstract*</label>
                <textarea name="paper[abstract]" id="abstract" class="form-control" rows="3" placeholder="Enter Abstract ...">{{ $paper->abstract }}</textarea>
                @if ($errors->has('abstract'))
                    <span class="help-block">{{ $errors->first('abstract') }}</span>
                @endif
            </div>

            <div class="form-group">
                <label for="keywords">Keyword</label>
                <select id="keywords" name="paper[keywords][]" class="form-control" multiple="multiple" data-placeholder="Fill keyword and press Enter" style="width: 100%;">
                    @if (isset($paper->keywords) && count($paper->keywords))
                        @foreach($paper->keywords as $keyword)
                            <option value="{{ $keyword }}" selected>{{ $keyword }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('author_paper_list', ["conference_id" => $conference->id]) }}" class="btn btn-info">
                <i class="fa fa-backward"></i> Paper List
            </a>
        </div>
    </div>
</form>
@endsection
@section('js')
    <script src="{{ asset('js/lib/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/author/edit.js') }}"></script>
@endsection
