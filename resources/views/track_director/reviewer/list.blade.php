@extends('layouts.admin.conference_layout')
@section('title','User Reviewer Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <div class="col-md-6">
                            <h3 class="box-title">User Reviewer List</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="user_list" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>User Name</th>
                                        <th>Full Name</th>
                                        <th>Gender</th>
                                        <th>Affiliation</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>Country</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($reviewers as $reviewer)
                                    <tr>
                                        <td>
                                            <a target="_blank" href="{{ route('track_director_user_view', ['conference_id'=>$conference->id, 'id'=>$reviewer->id]) }}">
                                                <img class="img-circle" src="{{ asset('/storage/' . $reviewer->image) }}" alt="Avatar" height="50" width="50"> {{ $reviewer->user_name }}
                                            </a>
                                        </td>
                                        <td><a target="_blank" href="{{ route('track_director_user_view', ['conference_id'=>$conference->id, 'id'=>$reviewer->id]) }}">
                                                {{ $reviewer->first_name }} {{ $reviewer->middle_name }} {{ $reviewer->last_name }}
                                            </a></td>
                                        <td>{{ $reviewer->gender }}</td>
                                        <td>{{ $reviewer->affiliation }}</td>
                                        <td>{{ $reviewer->phone }}</td>
                                        <td>{{ $reviewer->email }}</td>
                                        <td>{{ $reviewer->country }}</td>
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
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/track_director/reviewer/list.js') }}"></script>
@endsection
