@extends('layouts.admin.conference_layout')
@section('title','Special Event Management')
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
                            <h3 class="box-title">Special Event List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            <a href="{{ route('admin_special_event_create', ['conference_id' => $conference_id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add Special Event</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="special_event_list" class="table table-bordered table-striped">
                                <thead>
	                                <tr>
	                                    <th>Id</th>
	                                    <th>Name</th>
                                        <th>Date</th>
                                        <th>Start time</th>
                                        <th>End time</th>
                                        <th>Room</th>
                                        <th>Description</th>
	                                    <th>Edit</th>
	                                    <th>Delete</th>
	                                </tr>
                                </thead>
                                <tbody>
                                @foreach($specialEvents as $specialEvent)
                                    <tr>
                                        <td>{{ $specialEvent->id }}</td>
                                        <td>{{ $specialEvent->name }}</td>
                                        <td>{{ $specialEvent->date }}</td>
                                        <td>{{ $specialEvent->start_time }}</td>
                                        <td>{{ $specialEvent->end_time }}</td>
                                        @if($specialEvent->room == null)
                                            <td></td>
                                        @else
                                            <td>{{ $specialEvent->room->name }} in {{ $specialEvent->room->building->name }}</td>
                                        @endif
                                        <td>{{ $specialEvent->description }}</td>
                                        <td>
                                            <a href="{{ route('admin_special_event_edit', ['conference_id' => $conference_id, 'id' => $specialEvent->id]) }}" class="btn btn-info fa fa-edit"></a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger fa fa-trash" data-toggle="modal" data-target="#delete_special_event_{{ $specialEvent->id }}"></button>
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal Conference -->
                                    <div class="modal fade" id="delete_special_event_{{ $specialEvent->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_special_event_delete', [ 'conference_id' => $conference_id, 'id'=> $specialEvent->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $specialEvent->name }} ?</h4>
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
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/special_event/list.js') }}"></script>
@endsection