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
                        <h3 class="box-title">Paper List</h3>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="paper_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Track</th>
                                    <th>Assigned At</th>
                                    <th>Title</th>
                                    <th>Abstract</th>
                                    <th>Attach File</th>
                                    <th>Decide</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reviewAssignments as $reviewAssignment)
                                    <tr>
                                        <td>{{ $reviewAssignment->paper->id }}</td>
                                        <td>{{ $reviewAssignment->paper->track->name }}</td>
                                        <td>{{ $reviewAssignment->date_assigned }}</td>
                                        <td><a href="{{ route('reviewer_do_review', ["conference_id" => $conference->id, "id" => $reviewAssignment->id]) }}">{{ $reviewAssignment->paper->title }}</a></td>
                                        <td>{!! $reviewAssignment->paper->abstract !!}</td>
                                        <td>
                                            @if ($reviewAssignment->paper->attach_file)
                                                <a target="_blank" href="{{ asset('/storage/' . $reviewAssignment->paper->attach_file) }}" class="btn btn-primary"><span class="fa fa-download"></span> Attach File</a>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($reviewAssignment->date_confirmed)
                                                @if ($reviewAssignment->declined)
                                                    <span class="label label-danger">Rejected</span>
                                                @else
                                                    <span class="label label-success">Accepted</span>
                                                @endif
                                            @else
                                                <span class="label label-warning">Not Decided</span>
                                            @endif
                                        </td>
                                    </tr>
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
