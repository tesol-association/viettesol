@extends('layouts.admin.conference_layout')
@section('title','Review Form Management')
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
                            <h3 class="box-title">Review Form List</h3>
                        </div>
                        @can('create-review-form')
                            <div class="col-md-2 col-md-offset-6">
                                <a href="{{ route('admin_review_form_create', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add Review Form</a>
                            </div>
                        @endcan
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="review_form_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>File</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reviewForms as $reviewForm)
                                    <tr>
                                        <td>{{ $reviewForm->id }}</td>
                                        <td>{{ $reviewForm->name }}</td>
                                        <td>
                                            @if ($reviewForm->status == 'active')
                                                <span class="label label-success">{{ $reviewForm->status }}</span>
                                            @else
                                                <span class="label label-danger">{{ $reviewForm->status }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $reviewForm->created_at }}</td>
                                        <td>
                                            @if ($reviewForm->attach_file)
                                                <a target="_blank" href="{{ asset('/storage/' . $reviewForm->attach_file) }}" class="btn btn-primary"><span class="fa fa-download"></span> Attach File</a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('view-review-form')
                                                <a href="{{ route('admin_criteria_review_list', ["conference_id" => $conference->id, "review_form_id" => $reviewForm->id]) }}" class="btn btn-primary">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endcan
                                            @can('update-review-form')
                                                <a href="{{ route('admin_review_form_edit', ["conference_id" => $conference->id, "id" => $reviewForm->id]) }}" class="btn btn-info">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                            @endcan
                                            @can('delete-review-form')
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_review_form_{{ $reviewForm->id }}">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            @endcan
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal Conference -->
                                    <div class="modal fade" id="delete_review_form_{{ $reviewForm->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_review_form_delete', [ "conference_id" => $conference->id, 'id'=> $reviewForm->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $reviewForm->name }} ?</h4>
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
    <script src="{{ asset('js/admin/review_form/list.js') }}"></script>
@endsection
