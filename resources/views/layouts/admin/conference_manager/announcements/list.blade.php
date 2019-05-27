@extends('layouts.admin.conference_layout')
@section('title','Announcements Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('admin/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <div class="col-md-4">
                            <h3 class="box-title">Announcements List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            @can('create-announcement')
                            <a href="{{ route('admin_announcements_create', ['conference_id' => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add Announcements</a>
                            @endcan
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="announcement_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>Description</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($announcements as $announcement)
                                    <tr>
                                        <td>{{ $announcement->id }}</td>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ $announcement->body }}</td>
                                        <td>{{ $announcement->short_content }}</td>
                                        <td>{{ $announcement->expiry_date }}</td>
                                        <td>
                                            @if ($announcement->status == 'draft')
                                                <span class="label label-warning">Draft</span>
                                            @elseif ($announcement->status == 'approved')
                                                <span class="label label-info">Approved</span>
                                            @elseif ($announcement->status == 'published')
                                                <span  class="label label-primary">Published</span>
                                            @endif
                                        </td>
                                        <td>
                                            @can('update-announcement')
                                            <a href="{{ route('admin_announcements_edit', ["conference_id" => $conference->id, "id" => $announcement->id]) }}" class="btn btn-info">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            @endcan
                                            @can('delete-announcement')
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_announcements_{{ $announcement->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                            @endcan
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal announcements -->
                                    <div class="modal fade" id="delete_announcements_{{ $announcement->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_announcements_delete', ["conference_id" => $conference->id, 'id'=> $announcement->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $announcement->title }} ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    <!-- End:: Delete Modal Announcements -->
                                @endforeach
                                </tbody>
                                <tfoot>
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
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/announcements/list.js') }}"></script>
@endsection
