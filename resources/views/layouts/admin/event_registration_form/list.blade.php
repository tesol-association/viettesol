@extends('layouts.admin.layout')
@section('title','Event registration form')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('page-header')
List event
@endsection
@section('content')
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-body">
					<div class="table-responsive">
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Event_id</th>
									<th>Event</th>
									<th>Criteria</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									@foreach($events as $event)
									<td>{{ $event->id }}</td>
									<td>{{ $event->title }}</td>
									<td><a href="{{ route('criteria_additional_list',['id'=> $event->id]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a></td>
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