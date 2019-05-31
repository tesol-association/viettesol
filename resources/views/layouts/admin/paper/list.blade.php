@extends('layouts.admin.conference_layout')
@section('title','Paper Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('admin/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
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
                        @can('send-paper')
                        <div class="col-md-2 col-md-offset-6">
                            <a href="{{ route('admin_paper_create', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Send Paper</a>
                        </div>
                        @endcan
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="paper_list" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Track</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>View & Assign</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($papers as $paper)
                                    <tr>
                                        <td>{{ $paper->id }}</td>
                                        <td><a target="_blank" href="{{ route('admin_author_paper_view', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">{{ $paper->title }}</a></td>
                                        <td>{{ $paper->track->name }}</td>
                                        <td>{{ $paper->status }}</td>
                                        <td>{{ $paper->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin_paper_submission', ["conference_id" => $conference->id, "id" => $paper->id]) }}" class="btn btn-primary">View & Assign</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot class="filters">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
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
    <script src="{{ asset('admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/paper/list.js') }}"></script>
@endsection
