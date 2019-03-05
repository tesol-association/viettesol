@extends('layouts.admin.layout')
@section('title','User Management')
@section('css')
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <div class="col-md-4">
                        <h3 class="box-title">User List</h3>
                    </div>
                    <div class="col-md-2 col-md-offset-6">
                        <a href="{{ route('admin_user_create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Create New User </a>
                    </div>
                </div>
                <div class="box-body">
                    <table id="user_manager" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <td>User Name</td>
                                <td>Name</td>
                                <td>Initals</td>
                                <td>Gender</td>
                                <td>Affiliation</td>
                                <td>Phone</td>
                                <td>Email</td>
                                <td>Country</td>
                                <td>View</td>
                                <td>Edit</td>
                                <td>Delete</td>
                                <td>Login Able</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->initals }}</td>
                                <td>{{ $user->gender }}</td>
                                <td>{{ $user->affiliation }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->country }}</td>
                                <td>
                                    <a href="{{ route('admin_user_view',$user->id )}}" class="btn btn-block btn-primary">View</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin_user_edit',$user->id )}}" class="btn btn-block btn-primary">Edit</a>
                                </td>
                                <td>
                                    <form method="post" action="{{ route('admin_user_delete',['id'=> $user->id ]) }}">
                                        @csrf
                                        <div class="modal fade" id="delete_user_{{ $user->id }}" role="dialog">
                                          <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Are you sure delete user {{ $user->user_name }} ?</h4>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                    </form>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_user_{{ $user->id }}">Delete</button>
                                </td>
                                <td>
                                    @if($user->disable == '1')
                                        <form method="post" action="{{ route('admin_user_enable',['id'=> $user->id ]) }}">
                                            @csrf
                                            <div class="modal fade" id="enable_user_{{ $user->id }}" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Are you sure enable user {{ $user->user_name }} ?</h4>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Enable</button>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                                        </form>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#enable_user_{{ $user->id }}">Enable</button>
                                    @else
                                        <form method="post" action="{{ route('admin_user_disable',['id'=> $user->id ]) }}">
                                            @csrf
                                            <div class="modal fade" id="disable_user_{{ $user->id }}" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">Are you sure disable user {{ $user->user_name }} ?</h4>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger">Disable</button>
                                                  </div>
                                                </div>

                                              </div>
                                            </div>
                                        </form>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#disable_user_{{ $user->id }}">Disable</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#user_manager').DataTable();
        });
    </script>
@endsection