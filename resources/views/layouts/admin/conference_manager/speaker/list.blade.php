@extends('layouts.admin.conference_layout')
@section('title','Speakers Management')
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
                            <h3 class="box-title">Speakers List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            <a href="{{ route('admin_speakers_create', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add New Speaker</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="speakers_list" class="table table-bordered table-striped">
                                <thead>
	                                <tr>
	                                    <th>Id</th>
	                                    <th>Full Name</th>
                                        <th>Image</th>
                                        <th>Affiliate</th>
	                                    <th>Edit</th>
                                        <th>View</th>
	                                    <th>Delete</th>
	                                </tr>
                                </thead>
                                <tbody>
                                @foreach($speakers as $speaker)
                                    <tr>
                                        <td>{{ $speaker->id }}</td>
                                        <td>{{ $speaker->full_name }}</td>
                                        <td><img class="img-circle" src="{{ asset('/storage/' . $speaker->image) }}" alt="Avatar" height="50" width="50"></td>
                                        <td>{{ $speaker->affiliate }}</td>
                                        <td>
                                            <a href="{{ route('admin_speakers_edit', ["conference_id" => $conference->id, "id" => $speaker->id]) }}" class="btn btn-info fa fa-edit"></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin_speakers_view', ["conference_id" => $conference->id, "speaker_id" => $speaker->id]) }}" class="btn btn-primary fa fa-eye"></a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger fa fa-trash" data-toggle="modal" data-target="#delete_speakers_{{ $speaker->id }}"></button>
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal Conference -->
                                    <div class="modal fade" id="delete_speakers_{{ $speaker->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_speakers_delete', [ "conference_id" => $conference->id, 'id'=> $speaker->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $speaker->full_name }} ?</h4>
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
    <script src="{{ asset('js/admin/speakers/list.js') }}"></script>
@endsection
