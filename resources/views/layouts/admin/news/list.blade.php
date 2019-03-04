@extends('layouts.admin.layout')
@section('title','News Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('content')
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <div class="box">
                    <!-- /.box-header -->
                    <div class="box-header with-border">
                        <div class="col-md-4">
                            <h3 class="box-title">News List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            <a href="{{ route('admin_news_create') }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add New</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="new_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Slug</th>
                                    <th>Title</th>
                                    <th>Short Content</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                    <th>Updated By</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($news as $new)
                                    <tr>
                                        <td>{{ $new->id }}</td>
                                        <td>{{ $new->slug }}</td>
                                        <td>{{ $new->title }}</td>
                                        <td style="max-height:50px; max-width: 200px;">{{ $new->short_content }}</td>
                                        <td>
                                            @if (isset($new->tags) && count($new->tags))
                                                @foreach ($new->tags as $tag)
                                                    <span class="label label-success">{{ $tag }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if ($new->status == 'draft')
                                                <span class="label label-warning">Draft</span>
                                            @elseif ($new->status == 'published')
                                                <span class="label label-info">Published</span>
                                            @endif
                                        </td>
                                        <td>{{ $new->updated_at }}</td>
                                        <td>{{ $new->lastUpdatedBy->user_name }}</td>
                                        <td>
                                            <a href="{{ route('admin_news_edit', ["id" => $new->id]) }}" class="btn btn-info">Edit</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_news_{{ $new->id }}">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal News -->
                                    <div class="modal fade" id="delete_news_{{ $new->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_news_delete', ['id'=> $new->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $new->title }} ?</h4>
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
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <script src="{{ asset('js/admin/news/list.js') }}"></script>
@endsection
