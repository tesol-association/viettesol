@extends('layouts.admin.layout')
@section('title','Partner-Sponsor Management')
@section('css')
<link rel="stylesheet" href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection
@section('page-header')
List partner-sponsor
@endsection
@section('content')
<section class="content">
      <div class="row">
        <div class="col-xs-12">
      
          <div class="box">
            <div class="box-header">
              <div class="row">
                <div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
                    <h3 class="box-title">Data Table With Full Features</h3>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <a href="{{ route('admin_partner_create') }}" class="btn btn-warning">Create partner/sponsor</a>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Logo</th>
                  <th>Type</th>
                  <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($partners as $partner)
                <tr>
                	<td>{{ $partner->id }}</td>
                	<td>{{ $partner->name }}</td>
                	<td>{{ $partner->description }}</td>
                	<td>
                     <img src="{{ $partner->logo }}" alt="" width="200px" height="160px">
                  </td>
                  <td>
                    {{ $partner->type }}
                  </td>
                  <td>
                    <form method="post" action="{{ route('admin_partner_delete',['id'=> $partner->id ]) }}">
                        @csrf
                        <div class="modal fade" id="myModal_{{ $partner->id }}" role="dialog">
                          <div class="modal-dialog">
                          
                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Are you sure delete: {{ $partner->title }}</h4>
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
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal_{{ $partner->id }}">Delete</button>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                </tfoot>
              </table>
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