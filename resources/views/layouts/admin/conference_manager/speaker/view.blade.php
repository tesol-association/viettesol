@extends('layouts.admin.conference_layout')
@section('title','Update Speakers')
@section('content')
<div class="box box-default">
        <div class="box-header with-border">
            <div class="col-md-4">
                <h3 class="box-title">Speaker Information</h3>
            </div>
            <div class="col-md-2 col-md-offset-6">
                <a href="{{ route('admin_speakers_list', ["conference_id" => $conference->id]) }}" class="btn btn-block btn-info"><i class="fa fa-backward"></i> Speakers List</a>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="box box-primary">
                        <div style="text-align:center">
                            <img class="img-circle" src="{{ asset('/storage/' . $speaker->image) }}" alt="Speaker Avatar" width="250" height="250">
                            <h3 class="profile-username text-center">
                            	<a href="{{ $speaker->site_url }}" target="_blank">
                            		{{ $speaker->full_name }}
                            	</a>
                            </h3>
                            <p class="text-muted text-center">{{ $speaker->affiliate }}</p>
                        </div>
                    </div>
                    <div>
		                <p style="text-align:center">
		                	<a target="_blank" href="{{ asset('/storage/' . $speaker->attach_file) }}" class="btn btn-primary">
		                		<span class="fa fa-download">
		                			Attach File
		                		</span>
		                	</a> 	
		                </p>
		                <p style="text-align:center">
		                	<a target="_blank" href="{{ asset('/storage/' . $speaker->attach_file) }}">
			                	Download
			                </a>
		                </p>
		            </div>
		            <a href="" class="btn btn-primary btn-block">
		            	<b>Edit</b>
		            </a>
                </div>
                <div class="col-md-8">
                    <div class="box box-primary">
                    	<p style="text-align:justify">
                    		<strong>
                    			<h3> Abstract :</h3> 
                    		</strong>
                    	</p>
                    	<p style="text-align:justify">
                    		{{ $speaker->abstract }}
                    	</p>
                    	<p style="text-align:justify">
                    		<strong>
                    			<h3> Biography :</h3>
                    		</strong>
                    	</p>
                    	<p style="text-align:justify">
                    		{{ $speaker->biography }}
                    	</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
