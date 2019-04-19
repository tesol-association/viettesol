@extends('layouts.admin.conference_layout')
@section('title','TimeBlock Management')
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
                            <h3 class="box-title">TimeBlock List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            <a href="{{ route('admin_time_block_create', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add New time block</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="timeblock_list" class="table table-bordered table-striped">
                                <thead>
	                                <tr>
	                                    <th>Id</th>
	                                    <th>Date</th>
	                                    <th>Start time</th>
	                                    <th>End time</th>
	                                    <th>Edit</th>
	                                    <th>Delete</th>
	                                </tr>
                                </thead>
                                <tbody>
                                @foreach($timeBlocks as $timeBlock)
                                    <tr>
                                        <td>{{ $timeBlock->id }}</td>
                                        <td>{{ $timeBlock->date }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s',$timeBlock->start_time)->format('H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::createFromFormat('H:i:s',$timeBlock->end_time)->format('H:i') }}</td>
                                        <td>
                                            <a href="{{ route('admin_time_block_edit', ["conference_id" => $conference->id, "id" => $timeBlock->id]) }}" class="btn btn-info fa fa-edit"></a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger fa fa-trash" data-toggle="modal" data-target="#delete_time_block_{{ $timeBlock->id }}"></button>
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal Conference -->
                                    <div class="modal fade" id="delete_time_block_{{ $timeBlock->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_time_block_delete', [ "conference_id" => $conference->id, 'id'=> $timeBlock->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $timeBlock->date }} - {{ \Carbon\Carbon::createFromFormat('H:i:s',$timeBlock->start_time)->format('H:i') }}-{{ \Carbon\Carbon::createFromFormat('H:i:s',$timeBlock->end_time)->format('H:i') }} ?</h4>
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
    <script src="{{ asset('js/admin/time_block/list.js') }}"></script>
@endsection
