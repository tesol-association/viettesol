@extends('layouts.admin.conference_layout')
@section('title','Criteria Review Management')
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
                            <h3 class="box-title">Criteria Review List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            <a href="{{ route('admin_criteria_review_create', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add Criteria Review</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="criteria_review_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Possible Values</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($criteriaReviews as $criteriaReview)
                                    <tr>
                                        <td>{{ $criteriaReview->id }}</td>
                                        <td>{{ $criteriaReview->name }}</td>
                                        <td>{{ $criteriaReview->description }}</td>
                                        <td>{{ $criteriaReview->possible_values }}</td>
                                        <td>{{ $criteriaReview->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin_criteria_review_edit', ["conference_id" => $conference->id, "id" => $criteriaReview->id]) }}" class="btn btn-info">Edit</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_criteria_review_{{ $criteriaReview->id }}">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal Conference -->
                                    <div class="modal fade" id="delete_criteria_review_{{ $criteriaReview->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_criteria_review_delete', [ "conference_id" => $conference->id, 'id'=> $criteriaReview->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $criteriaReview->name }} ?</h4>
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
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/criteria_review/list.js') }}"></script>
@endsection
