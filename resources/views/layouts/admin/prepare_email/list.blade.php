@extends('layouts.admin.conference_layout')
@section('title','Prepared Email Management')
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
                            <h3 class="box-title">Email List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
{{--                            <a href="{{ route('admin_prepared_email_create', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add Email</a>--}}
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="prepared_email_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Email Key</th>
                                    <th>Subject</th>
{{--                                    <th>Body</th>--}}
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($emails as $email)
                                    <tr>
                                        <td>{{ $email->id }}</td>
                                        <td>{{ $email->email_key }}</td>
                                        <td>{{ $email->subject }}</td>
{{--                                        <td>{{ $email->body }}</td>--}}
                                        <td>{{ $email->created_at }}</td>
                                        <td>
{{--                                            @can('update-track')--}}
                                                <a href="{{ route('admin_prepared_email_edit', ["conference_id" => $conference->id, "id" => $email->id]) }}" class="btn btn-info"><i class="fa fa-edit"></i></a>
{{--                                            @endcan--}}
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
    <script src="{{ asset('admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/prepared_email/list.js') }}"></script>
@endsection