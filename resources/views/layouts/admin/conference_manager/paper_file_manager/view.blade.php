@extends('layouts.admin.conference_layout')
@section('title','Paper File Management')
@section('css')
    <link href="{{ asset('admin/dist/css/AdminLTE.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/admin/paper_file_manager/view.css') }}">
@endsection
@section('content')
<section class="content">
    <div class="box box-primary">
        <div class="box-header with-border">
            <div class="col-md-4">
                <h3 class="box-title">Paper File Management</h3>
            </div>
        </div>
        <div class="box-body">
            <div class="container pb-filemng-template">
                <div class="row">
                    <nav class="navbar navbar-default pb-filemng-navbar">
                        <div class="container-fluid">
                            <!-- Navigation -->
                            <div class="navbar-header">
                                <button type="button" class="pull-left navbar-toggle collapsed treeview-toggle-btn" data-toggle="collapse" data-target="#treeview-toggle" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>

                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#options" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="fa fa-gears"></span>
                                </button>

                                <!-- Search button -->
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#pb-filemng-navigation" aria-expanded="false">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="fa fa-share"></span>
                                </button>
                            </div>

                            <ul class="collapse navbar-collapse nav navbar-nav navbar-right" id="options">
                                <li><a href="#"><span class="fa fa-crosshairs fa-lg"></span></a></li>
                                <li><a href="#"><span class="fa fa-ellipsis-v fa-lg"></span></a></li>
                                <li><a href="#"><span class="fa fa-lg fa-server"></span></a></li>
                                <li><a href="#"><span class="fa fa-lg fa-minus"></span></a></li>
                                <li><a href="#"><span class="fa fa-lg fa-window-maximize"></span></a></li>
                                <li><a href="#"><span class="fa fa-lg fa-times"></span></a></li>
                            </ul>


                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse" id="pb-filemng-navigation">
                                <ul class="nav navbar-nav">
                                    <li><a href="#"><span class="fa fa-chevron-left fa-lg"></span></a></li>
                                    <li><a href="#"><span class="fa fa-chevron-right fa-lg"></span></a></li>
                                    <li class="pb-filemng-active"><a href="#"><span class="fa fa-file fa-lg"></span></a></li>
                                </ul>
                            </div>
                            <!-- /.navbar-collapse -->

                        </div>
                        <!-- /.container-fluid -->
                    </nav>
                    <div class="panel panel-default">
                        <div class="panel-body pb-filemng-panel-body">
                            <div class="row">
                                <div class="col-sm-3 col-md-4 pb-filemng-template-treeview">
                                    <div class="collapse navbar-collapse" id="treeview-toggle">
                                        <div class="css-treeview">
                                            <ul>
                                                <li><input type="checkbox"/><label for="document" class="document" >Document</label>
                                                    <ul>
                                                        @foreach ($tracks as $track)
                                                            <li ><input type="checkbox"/><label class="track" for="track" data-track_id = "{{ $track->id }}">Track {{ $track->name }}</label>
                                                                @if (!empty($track->papers))
                                                                    <ul>
                                                                        @foreach ($track->papers as $paper)
                                                                            <li><input type="checkbox"/><label class="paper" data-track_id = "{{ $track->id }}" data-paper_id = "{{ $paper->id }}"  for="paper">Paper {{ $paper->title }}</label>
                                                                                <ul>
                                                                                    @if (!empty($paper->authors))
                                                                                        @foreach ($paper->authors as $author)
                                                                                            @if ($author->pivot->seq == Config::get('constants.PAPER_AUTHOR.AUTHOR'))
                                                                                                <li><input type="checkbox"/><label class="author" for="author" data-track_id = "{{ $track->id }}" data-paper_id = "{{ $paper->id }}" data-author_id="{{ $author->id }}">Author {{ $author->full_name }}</label>
                                                                                                    <ul>
                                                                                                        @if (!empty($paper->attachFile))
                                                                                                            @if($paper->attachFile->file_type == 'pdf')
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $paper->attachFile->path) }}"><li><i class="fa fa-file-pdf-o"> {{ $paper->attachFile->original_file_name }}</i></li></a>
                                                                                                            @elseif($paper->attachFile->file_type == 'docx')
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $paper->attachFile->path) }}"><li><i class="fa fa-file-word-o"> {{ $paper->attachFile->original_file_name }}</i></li></a>
                                                                                                            @elseif($paper->attachFile->file_type == 'pptx')
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $paper->attachFile->path) }}"><li><i class="fa fa-file-powerpoint-o"> {{ $paper->attachFile->original_file_name }}</i></li></a>
                                                                                                            @elseif($paper->attachFile->file_type == 'xlsx')
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $paper->attachFile->path) }}"><li><i class="fa fa-file-excel-o"> {{ $paper->attachFile->original_file_name }}</i></li></a>
                                                                                                            @elseif($paper->attachFile->file_type == 'zip' || $paper->attachFile->file_type == '7z' || $paper->attachFile->file_type == 'rar')
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $paper->attachFile->path) }}"><li><i class="fa fa-file-zip-o"> {{ $paper->attachFile->original_file_name }}</i></li></a>
                                                                                                            @else
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $paper->attachFile->path) }}"><li><i class="fa fa-file-text-o"> {{ $paper->attachFile->original_file_name }}</i></li></a>
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    </ul>
                                                                                                </li>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif
                                                                                    @if (!empty($paper->reviewAssignment))
                                                                                        @foreach ($paper->reviewAssignment as $reviewAssignment)
                                                                                            @if (!empty($reviewAssignment->reviewer))
                                                                                                <li><input type="checkbox"/><label  class="reviewer" data-track_id = "{{ $track->id }}" data-paper_id = "{{ $paper->id }}" data-reviewer_id = "{{$reviewAssignment->reviewer->id }}" for="reviewer">Reviewer {{ $reviewAssignment->reviewer->full_name }}</label>
                                                                                                    <ul>
                                                                                                        @if (!empty($reviewAssignment->attachFile))
                                                                                                            @if($reviewAssignment->attachFile->file_type == 'pdf')
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $reviewAssignment->attachFile->path) }}"><li><i class="fa fa-file-pdf-o"> {{ $reviewAssignment->attachFile->original_file_name }}</i></li></a>
                                                                                                            @elseif($reviewAssignment->attachFile->file_type == 'docx')
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $reviewAssignment->attachFile->path) }}"><li><i class="fa fa-file-word-o"> {{ $reviewAssignment->attachFile->original_file_name }}</i></li></a>
                                                                                                            @elseif($reviewAssignment->attachFile->file_type == 'pptx')
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $reviewAssignment->attachFile->path) }}"><li><i class="fa fa-file-powerpoint-o"> {{ $reviewAssignment->attachFile->original_file_name }}</li></a>
                                                                                                            @elseif($reviewAssignment->attachFile->file_type == 'xlsx')
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $reviewAssignment->attachFile->path) }}"><li><i class="fa fa-file-excel-o"> {{ $reviewAssignment->attachFile->original_file_name }}</li></a>
                                                                                                            @elseif($reviewAssignment->attachFile->file_type == 'zip' || $reviewAssignment->attachFile->file_type == '7z' || $reviewAssignment->attachFile->file_type == 'rar')
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $reviewAssignment->attachFile->path) }}"><li><i class="fa fa-file-zip-o"> {{ $reviewAssignment->attachFile->original_file_name }}</i></li></a>
                                                                                                            @else
                                                                                                                <a target="_blank" href="{{ asset('/storage/' . $reviewAssignment->attachFile->path) }}"><li><i class="fa fa-file-text-o"> {{ $reviewAssignment->attachFile->original_file_name }}</i></li></a>
                                                                                                            @endif
                                                                                                        @endif
                                                                                                    </ul>
                                                                                                </li>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif
                                                                                </ul>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-9 col-md-8 pb-filemng-template-body">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
@endsection
@section('js')
    <script type="text/javascript" src="{{ asset('js/admin/paper_file_manager/view.js') }}"></script>
@endsection
