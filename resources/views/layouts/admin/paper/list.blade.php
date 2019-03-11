@extends('layouts.admin.conference_layout')
@section('title','Paper Management')
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
                            <h3 class="box-title">Paper List</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="paper_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Abstract</th>
                                    <th>Full Paper</th>
                                    <th>Attach File</th>
                                    <th>Track</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($papers as $paper)
                                    <tr>
                                        <td>{{ $paper->id }}</td>
                                        <td>{{ $paper->abstract }}</td>
                                        <td>{{ $paper->full_paper }}</td>
                                        <td>
                                            @if ($paper->attach_file)
                                                <a target="_blank" href="{{ asset('/storage/' . $paper->attach_file) }}" class="btn btn-primary"><span class="fa fa-download"></span> Attach File</a>
                                            @endif
                                        </td>
                                        <td>{{ $paper->track->name }}</td>
                                        <td>{{ $paper->status }}</td>
                                        <td>{{ $paper->created_at }}</td>
                                        <td>
                                            {{--<a href="{{ route('admin_paper_edit', ["conference_id" => $conference->id, "id" => $paper->id]) }}" class="btn btn-info">Edit</a>--}}
                                        </td>
                                        <td>
                                            {{--<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_paper_{{ $paper->id }}">Delete</button>--}}
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal Conference -->
                                    {{--<div class="modal fade" id="delete_paper_{{ $paper->id }}" role="dialog">--}}
                                        {{--<form method="post" action="{{ route('admin_paper_delete', [ "conference_id" => $conference->id, 'id'=> $paper->id ]) }}">--}}
                                            {{--@csrf--}}
                                            {{--<div class="modal-dialog">--}}
                                                {{--<!-- Modal content-->--}}
                                                {{--<div class="modal-content">--}}
                                                    {{--<div class="modal-header">--}}
                                                        {{--<button type="button" class="close" data-dismiss="modal">&times;</button>--}}
                                                        {{--<h4 class="modal-title">Are you sure delete: {{ $paper->name }} ?</h4>--}}
                                                    {{--</div>--}}
                                                    {{--<div class="modal-footer">--}}
                                                        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                                                        {{--<button type="submit" class="btn btn-danger">Delete</button>--}}
                                                    {{--</div>--}}
                                                {{--</div>--}}
                                            {{--</div>--}}
                                            {{--</form>--}}
                                        {{--</div>--}}
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
    <script src="{{ asset('js/admin/paper/list.js') }}"></script>
@endsection
