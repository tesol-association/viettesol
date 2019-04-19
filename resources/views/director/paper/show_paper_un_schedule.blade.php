@extends('layouts.admin.conference_layout')
@section('title','Paper Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="col-md-4">
                            <h3 class="box-title">Paper Result List</h3>
                        </div>
                    </div>
                    <!-- Start box-body paper accepted, revision, rejected-->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="paper_result_list" class="table table-bordered table-striped">
                                <thead class="filter_result">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="checkall_result"></th>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Track</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Schedule</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($paperResults as $paper)
                                    <tr data-conference_id="{{ $conference->id }}" data-paper_id="{{ $paper->id }}">
                                        <td><input type="checkbox" class="checkbox_result"></td>
                                        <td>{{ $paper->id }}</td>
                                        <td><a target="_blank" href="{{ route('admin_author_paper_view', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">{{ $paper->title }}</a></td>
                                        <td>{{ $paper->track->name }}</td>
                                        <td>
                                            @switch($paper->status)
                                                @case(Config::get('constants.PAPER_STATUS.ACCEPTED'))
                                                <span class="label label-success">Accept Paper</span>
                                                @break
                                                @case(Config::get('constants.PAPER_STATUS.REVISION'))
                                                <span class="label label-info">Revision Paper</span>
                                                @break
                                                @case(Config::get('constants.PAPER_STATUS.REJECTED'))
                                                <span class="label label-danger">Reject Paper</span>
                                                @break
                                            @endswitch
                                        </td>
                                        <td>{{ $paper->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn_paper_result btn btn-primary" data-conference_id="{{ $conference->id }}" data-paper_id="{{ $paper->id }}"> <i class="fa fa-plus"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <button type="button" class="btn_paper_result_all btn btn-primary"> Add </button>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- End box-body paper accepted, revision, rejected-->
                    <div class="box-header with-border">
                        <div class="col-md-4">
                            <h3 class="box-title">Paper UnSchedule List</h3>
                        </div>
                    </div>
                    <!-- Start box-body paper unschedule-->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="paper_unschedule_list" class="table table-bordered table-striped">
                                <thead class="filter_unschedule">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </thead>
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" class="checkall_unschedule"></th>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Track</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                        <th>Un Schedule</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($paperUnschedules as $paper)
                                    <tr data-conference_id="{{ $conference->id }}" data-paper_id="{{ $paper->id }}">
                                        <td><input type="checkbox" class="checkbox_unschedule"></td>
                                        <td>{{ $paper->id }}</td>
                                        <td><a target="_blank" href="{{ route('admin_author_paper_view', ['conference_id' => $conference->id, 'id' => $paper->id]) }}">{{ $paper->title }}</a></td>
                                        <td>{{ $paper->track->name }}</td>
                                        <td><span class="label label-primary">{{ $paper->status }} Paper</span></td>
                                        <td>{{ $paper->created_at }}</td>
                                        <td>
                                            <button type="button" class="btn_paper_unchedule btn btn-danger"  data-conference_id="{{ $conference->id }}" data-paper_id="{{ $paper->id }}"> <i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <button type="button" class="btn_paper_unchedule_all btn btn-danger"> Remove </button>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- End box-body paper unschedule-->
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
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/director/list_paper_un_schedule.js') }}"></script>
@endsection
