@extends('layouts.admin.conference_layout')
@section('title','Paper Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
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
                                    <th>Attach File</th>
                                    <th>Track</th>
                                    <th>Status</th>
                                    <th>Author</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>File</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($papers as $paper)
                                    <tr>
                                        <td>{{ $paper->id }}</td>
                                        <td>{{ $paper->title }}</td>
                                        <td>{!! $paper->abstract !!}</td>
                                        <td>
                                            @if ($paper->attach_file)
                                                <a target="_blank" href="{{ asset('/storage/' . $paper->attach_file) }}" class="btn btn-primary"><span class="fa fa-download"></span> Attach File</a>
                                            @endif
                                        </td>
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
                                        <td><button class="btn btn-primary"><i class="fa fa-send-o"></i></button></td>
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
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/author/list.js') }}"></script>
@endsection
