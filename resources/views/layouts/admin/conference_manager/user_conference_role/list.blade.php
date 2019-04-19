@extends('layouts.admin.conference_layout')
@section('title','User Conference Roles Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link href="{{ asset('admin/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
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
                            <h3 class="box-title">User Conference Roles List</h3>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="user_conference_role_list" class="table table-bordered table-striped">
                                <thead>
	                                <tr>
	                                    <th>User Name</th>
	                                    <th>Full Name</th>
	                                    <th>Email</th>
                                        <th>Roles</th>
	                                    <th>Action</th>
	                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td><img class="img-circle" src="{{ asset('/storage/' . $user->image) }}" alt="Avatar" height="50" width="50"> {{ $user->user_name }}</td>
                                        <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach($user->conferenceRoles as $role)
                                                <span class="label label-success">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary fa fa-plus" data-toggle="modal" data-target="#update_user_conference_role_{{ $user->id }}"></button>
                                        </td>
                                        <!-- Start:: Modal -->
                                        <div class="modal fade" id="update_user_conference_role_{{ $user->id }}" role="dialog">
                                            <form method="post" action="{{ route('admin_user_conference_roles_update',['conference_id' => $conference->id, 'id' =>$user->id]) }}">
                                                @csrf
                                                <div class="modal-dialog">
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h3>Select a conference role for {{ $user->user_name }}</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                            <select class="role_name form-control" name="name[]" multiple="multiple"  style="width: 100%">
                                                                @foreach($conferenceRoles as $conferenceRole)
                                                                    @if(in_array($conferenceRole->id, $user->conferenceRoleIds))
                                                                        <option value="{{ $conferenceRole->id }}" selected>{{ $conferenceRole->name }}</option>
                                                                    @else
                                                                        <option value="{{ $conferenceRole->id }}">{{ $conferenceRole->name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                                Cancel
                                                            </button>
                                                            <button type="submit" class="btn btn-danger">
                                                                Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        <!-- End:: Modal -->
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot class="filters">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
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
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/user_conference_role/list.js') }}"></script>
@endsection
