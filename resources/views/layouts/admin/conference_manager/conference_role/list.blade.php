@extends('layouts.admin.conference_layout')
@section('title','Conference Roles Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('admin/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')
	<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="col-md-4">
                            <h3 class="box-title">Conference Roles List</h3>
                        </div>
                        <div class="col-md-3 col-md-offset-5">
                            @can('create-conference-role')
                                <a href="{{ route('admin_conference_roles_create', ['conference_id' => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add New Conference Role</a>
                            @endcan
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="conference_role_list" class="table table-bordered table-striped">
                                <thead>
	                                <tr>
	                                    <th>Id</th>
	                                    <th>Name</th>
	                                    <th>Description</th>
	                                    <th>Action</th>
	                                </tr>
                                </thead>
                                <tbody>
                                @foreach($conferenceRoles as $conferenceRole)
                                    <tr>
                                        <td>{{ $conferenceRole->id }}</td>
                                        <td>{{ $conferenceRole->name }}</td>
                                        <td>{{ $conferenceRole->description }}</td>
                                        <td>
                                            @can('update-conference-role')
                                                <a href="{{ route('admin_conference_roles_edit', ['conference_id' => $conference->id, 'id' => $conferenceRole->id]) }}" class="btn btn-info fa fa-edit"></a>
                                            @endcan
                                            @can('delete-conference-role')
                                                <button type="button" class="btn btn-danger fa fa-trash" data-toggle="modal" data-target="#delete_conference_roles_{{ $conferenceRole->id }}"></button>
                                            @endcan
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal Conference Role -->
                                    <div class="modal fade" id="delete_conference_roles_{{ $conferenceRole->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_conference_roles_delete', [ 'conference_id' => $conference->id, 'id'=> $conferenceRole->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $conferenceRole->name }} ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    <!-- End:: Delete Modal Conference Role -->
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
    <script src="{{ asset('js/admin/conference_role/list.js') }}"></script>
@endsection
