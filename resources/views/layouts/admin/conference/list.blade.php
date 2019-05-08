@extends('layouts.admin.layout')
@section('title','Conference Management')
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
                            <h3 class="box-title">Conference List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            <a href="{{ route('admin_conference_create') }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add Conference</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="conference_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Path</th>
                                    <th>Title</th>
                                    <th>Slogan</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Venue</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>File</th>
                                    <th>Aciton</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($conferences as $conference)
                                    <tr>
                                        <td>{{ $conference->id }}</td>
                                        <td>{{ $conference->path }}</td>
                                        <td>{{ $conference->title }}</td>
                                        <td>{{ $conference->slogan }}</td>
                                        <td>{{ date('d/m/Y',strtotime( $conference->start_time)) }}</td>
                                        <td>{{ date('d/m/Y',strtotime( $conference->end_time)) }}</td>
                                        <td>{{ $conference->venue }}</td>
                                        <td>{{ $conference->description }}</td>
                                        <td>{{ $conference->created_at }}</td>
                                        <td>
                                            @if ($conference->attach_file)
                                                <a target="_blank" href="{{ asset('/storage/' . $conference->attach_file) }}" class="btn btn-primary"><span class="fa fa-download"></span> </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin_conference_view', ["id" => $conference->id]) }}" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                            <a href="{{ route('admin_conference_edit', ["id" => $conference->id]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_conference_{{ $conference->id }}"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal Conference -->
                                    <div class="modal fade" id="delete_conference_{{ $conference->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_conference_delete', ['id'=> $conference->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $conference->title }} ?</h4>
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
    <script src="{{ asset('js/admin/conference/list.js') }}"></script>
@endsection
