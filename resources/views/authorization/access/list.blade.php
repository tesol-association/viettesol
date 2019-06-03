@extends('layouts.admin.conference_layout')
@section('title','ACL Permission')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-toggle/css/bootstrap-toggle.min.css') }}">
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
                            <h3 class="box-title">Access List</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="access_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Role</th>
                                    <th>Permission</th>
                                    <th>Allowed</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($accesses as $access)
                                    <tr>
                                        <td>{{ $access->id }}</td>
                                        <td>{{ $access->role->name }}</td>
                                        <td>{{ $access->permission->name }}</td>
                                        <td>
                                            @can('set-up-conference-permission')
                                                @if ($access->allowed == 1)
                                                    <input class="allow_btn" type="checkbox" checked data-toggle="toggle" data-access-id="{{ $access->id }}">
                                                @else
                                                    <input class="allow_btn" type="checkbox" data-toggle="toggle" data-access-id="{{ $access->id }}">
                                                @endif
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="conference_id" value="{{ $conference->id }}">
@endsection
@section('js')
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/access/list.js') }}"></script>
@endsection
