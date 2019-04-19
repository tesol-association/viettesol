@extends('layouts.admin.layout')
@section('title','Contribution Review')

@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
<link href="{{ asset('admin/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
<style type="text/css">
	td{
		text-align: center;
	}
</style>
@endsection

@section('page-header')
Contribution History
@endsection

@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">

			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Data Table With All Contribution History</h3>
				</div>
				<div class="box-body">

					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<td> ID </td>
								<td> Contact ID </td>
								<td> Donator </td>
								<td> Time </td>
								<td> Amount </td>
								<td> Payment Method </td>
								<td> Transaction ID </td>
								<td> Delete </td>
							</tr>
						</thead>

						<tbody>
							@foreach($contributions as $contribution)
							<tr>
								<td> {{ $contribution->id }} </td>
								<td> {{ $contribution->contact_id }} </td>
								<td>
									@if ( $contribution->contact->contactType->name === "Individual" )
									{{ $contribution->contact->first_name }} {{ $contribution->contact->middle_name }} {{ $contribution->contact->last_name }}
									@else
									{{ $contribution->contact->organize_name }}
									@endif
								</td>
								<td> {{ $contribution->received }} </td>
								<td> {{ $contribution->unit }} {{ $contribution->amount }} </td>
								<td> {{ $contribution->payment_method_id }} </td>
								<td> {{ $contribution->transaction_id }} </td>
								<td>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_contribution{{ $contribution->id }}"> <i class="fa fa-trash">  </i> </button>

									<form method="post" action="{{ route('admin_contribution_delete',['id'=> $contribution->id ]) }}">
										@csrf
										<div class="modal fade" id="delete_contribution{{ $contribution->id }}" role="dialog">
										  <div class="modal-dialog">

											<!-- Modal content-->
											<div class="modal-content">
											  <div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Delete this log?</h4>
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
<script src="{{ asset('admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
<script src="{{ asset('admin/dist/js/demo.js') }}"></script>
<script>
	$(function () {
		$('#example1').DataTable({
            responsive: true,
        });
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
