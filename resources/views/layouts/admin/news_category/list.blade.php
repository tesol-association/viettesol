@extends('layouts.admin.layout')
@section('title','News Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/css/bootstrap-select.min.css">
    <link href="{{ asset('admin/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <div class="col-md-4">
                            <h3 class="box-title">News Category List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            <a href="{{ route('admin_news_category_create') }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="new_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($newsCategory as $newCategory)
                                    <tr>
                                        <td>{{ $newCategory->id }}</td>
                                        <td>{{ $newCategory->name }}</td>
                                        <td>{{ $newCategory->slug }}</td>
                                        <td>{{ $newCategory->description }}</td>
                                        <td>{{ $newCategory->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin_news_category_edit', ['id' => $newCategory->id]) }}" class="btn btn-info">Edit</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_news_{{ $newCategory->id }}">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal News -->
                                    <div class="modal fade" id="delete_news_{{ $newCategory->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_news_category_delete', ['id'=> $newCategory->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $newCategory->name }} ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    <!-- End:: Delete Modal News -->
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.5/js/bootstrap-select.min.js"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/lib/countrypicker.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/news/list.js') }}"></script>
@endsection
