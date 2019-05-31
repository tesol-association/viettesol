@extends('layouts.admin.conference_layout')
@section('title','Conference Gallery Management')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/dropzone/dist/min/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/fancybox/dist/jquery.fancybox.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin/conference_gallery/list.css') }}">
@endsection
@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <!-- /.box-header -->
                <div class="box-header with-border">
                    <div class="col-md-4">
                        <h3 class="box-title">Conference Gallery List</h3>
                    </div>
                    @can('create-conference-gallery')
                        <div class="col-md-3 col-md-offset-5">
                            <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#add_conference_gallery">
                                <i class="fa fa-plus"></i>
                                Add Conference Gallery
                            </button>
                            <div class="modal fade" id="add_conference_gallery" role="dialog">
                                <form method="post" action="{{ route('admin_conference_gallery_store', ["conference_id" => $conference->id]) }}" enctype="multipart/form-data">
                                @csrf
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h3 class="modal-title">Add New Conference Gallery</h3>
                                            </div>
                                            <div class="modal-body">
                                                <input type="file" name="image[]" id="image" accept="image/*" multiple>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endcan
                </div>
                <div class="box-body">
                    @foreach ($conferenceGallerys as $conferenceGallery)
                        <div class='col-md-4'>
                            <div class="card card-default">
                                <div class="card-header">
                                    @can('delete-conference-gallery')
                                        <div style="text-align:right;">
                                            <button type="button" class="btn btn-danger fa fa-close" data-toggle="modal" data-target="#delete_conference_gallery_{{ $conferenceGallery->id }}"></button>
                                        </div>
                                    @endcan
                                </div>
                                <div class="card-body card-6-6">
                                    <a class="fancybox" rel="fancybox" data-fancybox="images" data-width="2048" data-height="1024" href="{{ asset('/storage/' . $conferenceGallery->image_url) }}">
                                        <img src="{{ asset('/storage/' . $conferenceGallery->image_url) }}" class="img-responsive">
                                    </a>
                                </div>
                                <div class="card-footer"></div>
                            </div>
                            <div class="modal fade" id="delete_conference_gallery_{{ $conferenceGallery->id }}" role="dialog">
                                <form method="post" action="{{ route('admin_conference_gallery_delete', [ "conference_id" => $conference->id, 'id'=> $conferenceGallery->id ]) }}">
                                    @csrf
                                    <div class="modal-dialog">
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Are you sure delete ?</h4>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js')
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <script src="{{ asset('admin/bower_components/dropzone/dist/min/dropzone.min.js') }}"></script>
    <script src="{{ asset('js/admin/conference_gallery/list.js') }}"></script>
    <script src="{{ asset('admin/bower_components/fancybox/dist/jquery.fancybox.js') }}"></script>
@endsection
