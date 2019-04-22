@extends('layouts.admin.conference_layout')
@section('title','ACL Permission')
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
                            <h3 class="box-title">Permission List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            <button class="btn btn-block btn-info" data-toggle="modal" data-target="#add_permission"><i class="fa fa-plus"></i> Add Permission</button>
                            <!-- Start:: Add Permission Modal -->
                            <form action="{{ route('conference_acl_permission_store', ['conference_id' => $conference->id]) }}" method="POST">
                                @csrf
                                <div class="modal fade" id="add_permission" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span></button>
                                                <h4 class="modal-title">Add Permission</h4>
                                            </div>
                                            <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="permission_name">Name</label>
                                                        <input name="name" class="form-control" id="permission_name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Description</label>
                                                        <textarea name="description" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- End:: Add Permission Modal -->
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Edit</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $permission)
                                    <tr>
                                        <td>{{ $permission->id }}</td>
                                        <td>{{ $permission->name }}</td>
                                        <td>{{ $permission->description }}</td>
                                        <td>
                                            <button class="btn btn-info" data-toggle="modal" data-target="#edit_permission{{ $permission->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <!-- Start:: Update Permission Modal -->
                                            <form action="{{ route('conference_acl_permission_update', ['conference_id' => $conference->id, 'permission_id' => $permission->id]) }}" method="POST">
                                                @csrf
                                                <div class="modal fade" id="edit_permission{{ $permission->id }}" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span></button>
                                                                <h4 class="modal-title">Edit Permission</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="permission_name">Name</label>
                                                                    <input name="name" class="form-control" id="permission_name" value="{{ $permission->name }}">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label>Description</label>
                                                                    <textarea name="description" class="form-control" rows="3" placeholder="Enter ...">{{ $permission->description }}</textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                            <!-- End:: Update Permission Modal -->
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
@endsection
