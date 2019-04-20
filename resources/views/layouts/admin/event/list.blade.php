@extends('layouts.admin.layout')
@section('title','Event Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
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
                            <h3 class="box-title">Event List</h3>
                        </div>
                        <div class="col-md-2 col-md-offset-6">
                            <a href="{{ route('admin_event_create') }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i> Add Event</a>
                        </div>
                    </div>
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="event_list" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Slug</th>
                                    <th>Title</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Venue</th>
                                    <th>Trainer</th>
                                    <th>Fee</th>
                                    <th>Categories</th>
                                    <th>Tags</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                    <th>Updated By</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td>{{ $event->id }}</td>
                                        <td>{{ $event->slug }}</td>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ date('H:i d/m/Y',strtotime($event->start_time)) }}</td>
                                        <td>{{ date('H:i d/m/Y',strtotime($event->end_time)) }}</td>
                                        <td>{{ $event->venue }}</td>
                                        <td>{{ $event->trainer }}</td>
                                        <td>{{ $event->fee }} VNĐ</td>
                                        <td>
                                            @if (isset($event->categoryLinks) && count($event->categoryLinks))
                                                @foreach ($event->categoryLinks as $categoryLink)
                                                    <span class="label label-success">{{ $categoryLink->category->name }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($event->tags) && count($event->tags))
                                                @foreach ($event->tags as $tag)
                                                    <span class="label label-success">{{ $tag }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            @if ($event->status == 'draft')
                                                <span class="label label-warning">Draft</span>
                                            @elseif ($event->status == 'published')
                                                <span class="label label-info">Published</span>
                                            @endif
                                        </td>
                                        <td>{{ date('H:i d/m/Y',strtotime($event->updated_at)) }}</td>
                                        <td>{{ $event->lastUpdatedBy->user_name }}</td>
                                        <td>
                                            <a href="{{ route('admin_event_edit', ["id" => $event->id]) }}" class="btn btn-info">Edit</a>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_event_{{ $event->id }}">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Start:: Delete Modal Event -->
                                    <div class="modal fade" id="delete_event_{{ $event->id }}" role="dialog">
                                        <form method="post" action="{{ route('admin_event_delete', ['id'=> $event->id ]) }}">
                                            @csrf
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title">Are you sure delete: {{ $event->title }} ?</h4>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    <!-- End:: Delete Modal Event -->
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
    <script src="{{ asset('js/admin/event/list.js') }}"></script>
@endsection
