@extends('layouts.admin.conference_layout')
@section('title','Session Type Management')
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
                            <h3 class="box-title">Session Type List</h3>
                        </div>
                        @can('create-session-type', \App\Models\SessionType::class)
                            <div class="col-md-2 col-md-offset-6">
                                <a href="{{ route('admin_session_type_create', ['conference_id' => $conference_id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add Session Type</a>
                            </div>
                        @endcan
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="session_type_list" class="table table-bordered table-striped">
                                <thead>
	                                <tr>
	                                    <th>Id</th>
	                                    <th>Name</th>
                                        <th>Duration (minutes)</th>
                                        <th>Abstract lenght (words)</th>
                                        <th>Description</th>
                                        @can('update-session-type', \App\Models\SessionType::class)
	                                        <th>Edit</th>
                                        @endcan
                                        @can('delete-session-type', \App\Models\SessionType::class)
	                                        <th>Delete</th>
                                        @endcan
	                                </tr>
                                </thead>
                                <tbody>
                                @foreach($sessionTypes as $sessionType)
                                    <tr>
                                        <td>{{ $sessionType->id }}</td>
                                        <td>{{ $sessionType->name }}</td>
                                        <td>{{ $sessionType->length }}</td>
                                        <td>{{ $sessionType->abstract_length }}</td>
                                        <td>{{ $sessionType->description }}</td>
                                        @can('update-session-type', \App\Models\SessionType::class)
                                        <td>
                                            <a href="{{ route('admin_session_type_edit', ['conference_id' => $conference_id, 'id' => $sessionType->id]) }}" class="btn btn-info fa fa-edit"></a>
                                        </td>
                                        @endcan
                                        @can('delete-session-type', \App\Models\SessionType::class)
                                        <td>
                                            <button type="button" class="btn btn-danger fa fa-trash" data-toggle="modal" data-target="#delete_session_type_{{ $sessionType->id }}"></button>
                                        </td>
                                        @endcan
                                    </tr>
                                    <!-- Start:: Delete Modal Conference -->
                                    <div class="modal fade" id="delete_session_type_{{ $sessionType->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_session_type_delete', [ 'conference_id' => $conference_id, 'id'=> $sessionType->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $sessionType->name }} ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- End:: Delete Modal Conference -->
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
    <script src="{{ asset('js/admin/session_types/list.js') }}"></script>
@endsection
