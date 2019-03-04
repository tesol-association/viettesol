@extends('layouts.admin.layout')
@section('title','Contact Management')

@section('css')

@endsection

@section('page-header')
All Contacts
@endsection

@section('content')
<section class="content">
    <div class="row">
        <div class="col-xs-12">
      
        	<div class="box">
	            <div class="box-header">
	            	<h3 class="box-title">Data Table With All Contacts</h3>
	            </div>
				<div class="box-body">

					<form method="get" action="{{ route('admin_contact_create') }}">
                        <button type="submit" class="btn btn-primary"> New </button>
                    </form>

                    <br/>

					<table id="example1" class="table table-bordered table-striped">
					    <thead>
					        <tr>
					        	<td> ID </td>
					        	<td> Type </td>
					        	<td> Name </td>
					        	<td> Country </td>
					        	<td> Website </td>
					        	<td>  </td>
					        	<td>  </td>
					        	<td>  </td>
					        </tr>
					    </thead>

					    <tbody>
					    	@foreach($contacts as $contact)
					        <tr>
					            <td>{{ $contact->id }}</td>
					            <td>{{ $contact->type }}</td>
					            <td>
					            	@if($contact->type == "Individual")
					            	{{ $contact->first_name." ".$contact->middle_name." ".$contact->last_name }}
					            	@elseif($contact->type == "Organization")
					            	{{ $contact->organize_name }}
					            	@else
					            	{{ $contact->organize_name }}
					            	@endif
					            </td>
					            <td>{{ $contact->country }}</td>
					            <td>{{ $contact->website }}</td>
					            <td><a href="#" class="btn btn-primary"> View </a></td>
					            <td><a href="#" class="btn btn-primary"> Edit </a></td>
					            <td>
					            	<form action="#" method="post">
					                	@csrf
					                	<button class="btn btn-danger" type="submit"> Delete </button>
					                </form>
					            </td>
					        </tr>
					        @endforeach
					    </tbody>

					</table>

				</div>
			</div>
		</div>
	</div>
</section>
@endsection

@section('js')
<script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script>
	$(function () {
		$('#example1').DataTable()
		$('#example2').DataTable({
    		'paging'      : true,
    		'lengthChange': false,
    		'searching'   : false,
    		'ordering'    : true,
    		'info'        : true,
    		'autoWidth'   : false
    	})
	})
</script>
@endsection