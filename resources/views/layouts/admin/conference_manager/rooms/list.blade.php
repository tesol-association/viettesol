@extends('layouts.admin.conference_layout')
@section('title','Rooms Management')
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
                            <h3 class="box-title">Room List Of {{ $building->name }}</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-4">
                            @can('create-room')
                                <a href="{{ route('admin_rooms_create', ['conference_id' => $conference->id, 'building_id' => $building_id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add New Room</a>
                            @endcan
                        </div>
                        <div class="col-md-2">
                            @can('view-building')
                                <a href="{{ route('admin_buildings_list', ['conference_id' => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Buildings List</a>
                            @endcan
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="rooms_list" class="table table-bordered table-striped">
                                <thead>
	                                <tr>
	                                    <th>Id</th>
	                                    <th>Name</th>
	                                    <th>Abbrev</th>
	                                    <th>Description</th>
	                                    <th>Action</th>
	                                </tr>
                                </thead>
                                <tbody>
                                @foreach($rooms as $room)
                                    <tr>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->abbrev }}</td>
                                        <td>{{ $room->description }}</td>
                                        <td>
                                            @can('update-room')
                                                <a href="{{ route('admin_rooms_edit', ["conference_id" => $conference->id, "building_id" => $building_id, "id" => $room->id]) }}" class="btn btn-info fa fa-edit"></a>
                                            @endcan
                                            @can('delete-room')
                                                <button type="button" class="btn btn-danger fa fa-trash" data-toggle="modal" data-target="#delete_rooms_{{ $room->id }}"></button>
                                            @endcan
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal Conference -->
                                    <div class="modal fade" id="delete_rooms_{{ $room->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_rooms_delete', [ "conference_id" => $conference->id, "building_id" => $building_id, 'id'=> $room->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $room->name }} ?</h4>
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
    <script src="{{ asset('js/admin/rooms/list.js') }}"></script>
@endsection
