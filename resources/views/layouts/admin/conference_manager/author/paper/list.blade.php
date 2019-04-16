@extends('layouts.admin.conference_layout')
@section('title','Paper Author Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="col-md-4">
                            <h3 class="box-title">Paper Author</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="paper_list" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Title</th>
                                        <th>Abstract</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($papers as $paper)
                                    <tr>
                                        <td>{{ $paper->id }}</td>
                                        <td>
                                            @foreach ($paper->authors as $author)
                                                @if ($author->pivot->seq == 0)
                                                <a target="_blank" href="{{ route('admin_author_view', ['conference_id' => $conference->id, 'id'=>$author->id] ) }}"> {{ $author->full_name }} </a>
                                                @endif
                                            @endforeach
                                            @foreach ($paper->authors as $author)
                                                @if ($author->pivot->seq != 0)
                                                    <a target="_blank" href="{{ route('admin_author_view', ['conference_id' => $conference->id, 'id'=>$author->id] ) }}"> , {{ $author->full_name }} </a>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $paper->title }}</td>
                                        <td><a target="_blank" href="{{ route('admin_author_paper_view', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">ABSTRACT</a></td>
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
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/paper/list.js') }}"></script>
@endsection
