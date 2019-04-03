@extends('layouts.admin.layout')
@section('title','Event registration form criteria')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('page-header')
List criteria other of event registration
@endsection
@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">Create additional criteria for the event registration form</h3>
					<div class="box-tools pull-right">
						<a href="{{ route('event_registration_form_createCriteria',['event_id'=>$event_id]) }}" class="btn btn-block btn-info"><i class="fa fa-plus"></i>Create additional criteria</a>
					</div>
				</div>
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>id</th>
									<th>Event_id</th>
									<th>Name</th>
									<th>Type</th>
									<th>Description</th>
									<th>Possible Values</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									@foreach($criteriaAdditionals as $criteriaAdditional)
									<td>{{ $criteriaAdditional->id }}</td>
									<td>{{ $criteriaAdditional->event_id }}</td>
									<td>{{ $criteriaAdditional->name }}</td>
									<td>
										@foreach($types as $key => $type)
										@if($key == $criteriaAdditional->type )
										{{ $type }}   
										@endif
										@endforeach
									</td>
									<td>{{ $criteriaAdditional->description }}</td>
									<td>
										@foreach(json_decode($criteriaAdditional->possible_values) as $possible_value)
										@if($possible_value != null)
										<button type="button" class="btn btn-primary btn-sm btn-flat">{{ $possible_value }}</button>
										@endif
										@endforeach
									</td>
									<td>
										<form method="post" action="{{ route('event_registration_form_deleteCriteria',['id'=> $criteriaAdditional->id ]) }}">
											@csrf
											<div class="modal fade" id="myModal_{{ $criteriaAdditional->id }}" role="dialog">
												<div class="modal-dialog">

													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">Are you sure delete: {{ $criteriaAdditional->name }}</h4>
														</div>
														<div class="modal-footer">
															<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															<button type="submit" class="btn btn-danger">Delete</button>
														</div>
													</div>

												</div>
											</div>
										</form>
										<!-- </div> -->
										<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal_{{ $criteriaAdditional->id }}">Delete</button>
									</td>
								</tr>
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