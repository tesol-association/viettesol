@extends('layouts.admin.conference_layout')
@section('title','Update Speakers')
@section('content')
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">View Speaker Information</h3>
        <div class="box-tools pull-right">
            <a href="{{ route('admin_speakers_list', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> speakers List</a>
        </div>
    </div>

    <div class="box-body">
		<div class="content-msg">
			<h2 style="text-align:center">
				<a href="{{ $speaker->site_url }}">
					{{ $speaker->full_name }}
				</a>
			</h2>
			<p style="text-align:center">
				{{ $speaker->affiliate }}
			</p>
			<div class="col-md-2">
				<p style="text-align:center">
					<img src="{{ asset('/storage/' . $speaker->image) }}" style="height:200px; width:150px">
				</p>
			</div>
			<div class="col-md-10">
				<p style="text-align:justify">
					<strong>
						Biography : 
					</strong>
					 {{ $speaker->biography }}
				</p>

				<p style="text-align:justify">
					<strong>
						Abstract : 
					</strong>
					 {{ $speaker->abstract }}
				</p>
				<p style="text-align:justify">
					@if ($speaker->attach_file)
                        <a target="_blank" href="{{ asset('/storage/' . $speaker->attach_file) }}" class="btn btn-primary"><span class="fa fa-download"></span> Attach File</a>
                    @endif
				</p>
			</div>
		</div>
    </div>

    <div class="box-footer">
    	<div class="col-md-6 col-md-offset-6">
    		<a href="{{ route('admin_speakers_edit', ["conference_id" => $conference->id, "id" => $speaker->id]) }}" class="btn btn-info"><i class="fa fa-edit">Edit</i></a>
    	</div>
    </div>
</div>
@endsection
