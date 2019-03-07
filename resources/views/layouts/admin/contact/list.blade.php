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
					            <td>
					            	<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#showDetails"> View </button>

					            	<form method="post" action="#">
                                        @csrf
                                        <div class="modal fade" id="showDetails" role="dialog">
                                          <div class="modal-dialog">
                                          
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title"> Details of Contact with ID {{ $contact->id }} </h4>
                                                <br/>
                                                <table style="border: 0; width: 100%">
                                                	<tr>
                                                		<td> <p style="font-size: 20"> Type: </p></td>
                                                		<td> <p style="font-size: 20"> {{ $contact->type }} </p></td>
                                                	</tr>

                                                	<tr>
                                                		<td> <p style="font-size: 20"> Name: </p></td>
                                                		<td> 
                                                			@if($contact->type != "Individual")
                                                			{{ "Not used with this type." }}
                                                			@endif
                                                			<p style="font-size: 20"> {{ $contact->first_name." ".$contact->middle_name." ".$contact->last_name }} </p>
                                                		</td>
                                                	</tr>
                                                	<tr>
                                                		<td> 
                                                			@if($contact->type != "Organization")
                                                			{{ "Not used with this type." }}
                                                			@endif
                                                			<p style="font-size: 20"> Organization Name: </p>
                                                		</td>
                                                		<td> <p style="font-size: 20"> {{ $contact->organize_name }} </p></td>
                                                	</tr>
                                                	<tr>
                                                		<td> <p style="font-size: 20"> Address: </p></td>
                                                		<td> <p style="font-size: 20"> {{ $contact->address }} </p></td>
                                                	</tr>
                                                	<tr>
                                                		<td> <p style="font-size: 20"> Email: </p></td>
                                                		<td> <p style="font-size: 20"> {{ $contact->email }} </p></td>
                                                	</tr>
                                                	<tr>
                                                		<td> <p style="font-size: 20"> Phone: </p></td>
                                                		<td> <p style="font-size: 20"> {{ $contact->phone }} </p></td>
                                                	</tr>
                                                	<tr>
                                                		<td> <p style="font-size: 20"> Fax: </p></td>
                                                		<td> <p style="font-size: 20"> {{ $contact->fax }} </p></td>
                                                	</tr>
                                                	<tr>
                                                		<td> <p style="font-size: 20"> Website: </p></td>
                                                		<td> <p style="font-size: 20"> {{ $contact->website }} </p></td>
                                                	</tr>
                                                	<tr>
                                                		<td> <p style="font-size: 20"> Country: </p></td>
                                                		<td> <p style="font-size: 20"> {{ $contact->country }} </p></td>
                                                	</tr>
                                                	<tr>
                                                		<td> <p style="font-size: 20"> Note: </p></td>
                                                		<td> <p style="font-size: 20"> {{ $contact->note }} </p></td>
                                                	</tr>
                                                </table>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                              </div>
                                            </div>
                                            
                                          </div>
                                        </div>
                                    </form>
					            </td>
					            <td><a href="{{ route('admin_contact_edit', ["id" => $contact->id]) }}" class="btn btn-primary"> Edit </a></td>
					            <td>
					            	<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_contact{{ $contact->id }}">Delete</button>

					            	<form method="post" action="{{ route('admin_contact_delete',['id'=> $contact->id ]) }}">
                                        @csrf
                                        <div class="modal fade" id="delete_contact{{ $contact->id }}" role="dialog">
                                          <div class="modal-dialog">
                                          
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Are you sure you want to delete contact with ID {{ $contact->id }} ?</h4>
                                              </div>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                              </div>
                                            </div>
                                            
                                          </div>
                                        </div>
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